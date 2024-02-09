<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\ApisController;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ApiObj;
    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $details )
    {
        $this->ApiObj   = new ApisController();
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            prr(['DETAILS' => $this->details]);
            $this->ApiObj->Post_API_Signature(
                $this->details['api_slug'],
                $this->details['api_text'],
                $this->details['post_array'],
                $this->details['specific_keys'],
                $this->details['only_on_success'],
                $this->details['json_reponse'],
                $this->details['get_type']
            );
        }
        catch ( \Exception$e )
        {
            prr( ['SendOrder::Exception' => $e->getMessage()] );
            dispatch( new static( [
                'api_slug'        => $this->details['api_slug'],
                'api_text'        => $this->details['api_text'],
                'post_array'      => $this->details['post_array'],
                'specific_keys'   => $this->details['specific_keys'],
                'only_on_success' => $this->details['only_on_success'],
                'json_reponse'    => $this->details['json_reponse'],
                'get_type'        => $this->details['get_type']
            ] ) );
            sleep( rand( 1, 3 ) );
        }
        catch ( \Error$e )
        {
            prr( ['SendOrder::Error' => $e->getMessage()] );
            dispatch( new static( [
                'api_slug'        => $this->details['api_slug'],
                'api_text'        => $this->details['api_text'],
                'post_array'      => $this->details['post_array'],
                'specific_keys'   => $this->details['specific_keys'],
                'only_on_success' => $this->details['only_on_success'],
                'json_reponse'    => $this->details['json_reponse'],
                'get_type'        => $this->details['get_type']
            ] ) );
            sleep( rand( 1, 3 ) );
        }
    }
}
