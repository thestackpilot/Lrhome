<?php

function compute_delay( $now, $hour, $minute, $second )
{
    $h     = intval( $now->format( 'H' ) );
    $m     = intval( $now->format( 'i' ) );
    $s     = intval( $now->format( 's' ) );
    $delay = ( $hour + 23 - $h ) % 24;
    $delay = $delay * 60 + ( 60 + $minute - $m );
    $delay = $delay * 60 + ( 60 + $second - $s );

    return $delay;
}

die( compute_delay( new \DateTime(), 23, 0, 0 ).PHP_EOL );

function getTimestampsByDescription1( string $xml, string $description )
{
    $timestamps = [];

    echo 'XML: '.print_r( $xml, 1 );

    $xml = simplexml_load_string( $xml );

    foreach ( $xml->url as $url )
    {

        echo $url->loc.PHP_EOL;

    }

}

// die( print_r( file_get_contents( 'https://leelow.pk/products/canbebe-jumbo-pack-for-newborn-84pcs' ), 1 ).PHP_EOL );

function get_response( $url )
{
    $curl = curl_init();

    curl_setopt_array( $curl, array(
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12',
        CURLOPT_HTTPHEADER     => array(
            'Cookie: _landing_page=%2Fproducts%2Fcanbebe-jumbo-pack-for-newborn-84pcs; _orig_referrer=; _s=0d0c64df-89b3-43e5-93f4-0e07bc17b669; _shopify_s=0d0c64df-89b3-43e5-93f4-0e07bc17b669; _shopify_y=a17da004-313c-46d0-bb9f-da7b8561dbdc; _y=a17da004-313c-46d0-bb9f-da7b8561dbdc; localization=PK; secure_customer_sig='
        )
    ) );

    $response = curl_exec( $curl );

    curl_close( $curl );

    // echo print_r( $response, 1 ).PHP_EOL;

    return $response;
}

$xml = get_response( 'https://leelow.pk/sitemap_products_1.xml?from=6204527837340&to=6219234541724' ); // file_get_contents( 'https://leelow.pk/sitemap_products_1.xml?from=6204527837340&to=6219234541724' );

getTimestampsByDescription1( $xml, "Intrusion detected" );

die( PHP_EOL );

class TextInput
{
    public $value;

    public function add( $text )
    {
        $this->value .= $text;
    }

    public function getValue()
    {
        return $this->value;
    }

}

class NumericInput extends TextInput
{
    public function add( $text )
    {
        $this->value .= preg_replace( "/[^0-9.]/", "", $text );
    }

}

$input = new NumericInput();
$input->add( '1' );
$input->add( 'a' );
$input->add( 'A' );
$input->add( '0' );
$input->add( '1AB2' );
echo $input->getValue();

die( PHP_EOL );

class ChainLink
{
    const SIDE_LEFT = 1;

    const SIDE_NONE = 0;

    const SIDE_RIGHT = 2;

    private $left, $right;

    public function append( ChainLink $link ): void
    {
        $this->right = $link;
        $link->left  = $this;
    }

    public function longerSide(): int
    {
        $left = $right = 0;

        if ( ! $this->left && ! $this->right )
        {
            return self::SIDE_NONE;
        }

        if ( ! $this->left )
        {
            return self::SIDE_RIGHT;
        }

        if ( ! $this->right )
        {
            return self::SIDE_LEFT;
        }

        if ( $this->left )
        {
            $left = $this->checkLengthOfSide( $this->left, 'left' );
        }

        if ( $this->right )
        {
            $right = $this->checkLengthOfSide( $this->right, 'right' );
        }

        echo "{$left} VS {$right}".PHP_EOL;

        return $right > $left ? self::SIDE_RIGHT : ( $right == $left ? self::SIDE_NONE : self::SIDE_LEFT );
    }

    private function checkLengthOfSide( $chain, $side )
    {
        $return = 0;

        if ( $chain->{$side} )
        {
            $return = 1;
            $return += $this->checkLengthOfSide( $chain->{$side}, $side );
        }

        echo "RETURN: {$return}\n";

        return $return;
    }

}

$left   = new ChainLink();
$middle = new ChainLink();
$right  = new ChainLink();
$right1 = new ChainLink();
$left->append( $middle );
$middle->append( $right );
$right->append( $right1 );
echo print_r( $middle, 1 ).PHP_EOL;
var_dump( $middle->longerSide() == ChainLink::SIDE_RIGHT );

die();

class Pipeline
{
    public static function make_pipeline( ...$funcs )
    {
        return function ( $arg ) use ( $funcs )
        {

            for ( $i = 0; $i < count( $funcs ); $i++ )
            {
                $arg = $funcs[$i]( $arg );
            }

            return $arg;
        };
    }

}

$fun = Pipeline::make_pipeline( function ( $x )
{
    return $x * 3;}, function ( $x )
{
    return $x + 1;}, function ( $x )
{
    return $x / 2;} );
echo $fun( 3 ); # should print 5

die( PHP_EOL );

$cols = "property.*"
    .",user.user_id,user.email AS landlord_email,user.renewal_scheduled"
    .",CONCAT(user.first_name, ' ', user.last_name) AS landlord_name"
    .",lease.lease_id"
    .",lease_period.lease_period_id,lease_period.archive"
    .",tenants_contract.tenants_contract_id,tenants_contract.pay_rent_flag"
    .",tenants_contract.payment_method,tenants_contract.send_invoices"
    .",tenants_contract.amount_due"
    .",lease_payments.archive,lease_payments.due_date"
    .",tenants.*"
    .",bank_transfer_settings.*"
    .",cheque_settings.*"
    .",other_method_settings.*";
$query = "SELECT DISTINCT {$cols} FROM property"
    ." LEFT JOIN user ON property.user_id=user.user_id"
    ." LEFT JOIN lease ON property.property_id=lease.property_id"
    ." LEFT JOIN lease_period ON lease.lease_id=lease_period.lease_id"
    ." LEFT JOIN tenants_contract ON lease_period.lease_period_id=tenants_contract.lease_period_id"
    ." LEFT JOIN lease_payments ON lease_period.lease_period_id=lease_payments.lease_period_id"
    ." LEFT JOIN tenants ON tenants_contract.tenants_id=tenants.tenants_id"
    ." LEFT JOIN bank_transfer_settings ON ((tenants_contract.tenants_contract_id=bank_transfer_settings.tenants_contract_id) OR (bank_transfer_settings.tenants_contract_id IS NULL))"
    ." LEFT JOIN cheque_settings ON ((tenants_contract.tenants_contract_id=cheque_settings.tenants_contract_id) OR (cheque_settings.tenants_contract_id IS NULL))"
    ." LEFT JOIN other_method_settings ON ((tenants_contract.tenants_contract_id=other_method_settings.tenants_contract_id) OR (other_method_settings.tenants_contract_id IS NULL))"
    ." WHERE property.archive <> 1"
    ." AND user.user_id = 3881"
    ." AND user.renewal_scheduled > DATE(NOW())"
    ." AND lease_period.archive <> 1"
    ." AND tenants_contract.pay_rent_flag = 1"
    ." AND tenants_contract.send_invoices = 1"
    ." AND lease_payments.archive <> 1";

die( print_r( $query, 1 ) );

class TextInput
{
    protected $str = '';

    public function add( $text )
    {
        $this->str .= $text;
    }

    public function getValue()
    {
        return $this->str;
    }

}

class NumericInput extends TextInput
{
    public function add( $text )
    {

        if ( is_numeric( $text ) )
        {
            $this->str .= $text;
        }

    }

}

$input = new NumericInput();
$input->add( '1' );
$input->add( '123.11' );
$input->add( '0' );
echo $input->getValue();
die( PHP_EOL );

function getTimestampsByDescription( string $xml, string $description ): array
{
    $timestamps = [];
    $xml        = simplexml_load_string( $xml );

    foreach ( $xml->event as $event )
    {

        if ( strcmp( (string) $event->description, $description ) === 0 )
        {
            $timestamps[] = (string) $event->attributes()->timestamp;
        }

    }

    return $timestamps;
}

$xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<log>
    <event timestamp="1614285589">
        <description>Intrusion detected</description>
    </event>
    <event timestamp="1614286432">
        <description>Intrusion ended</description>
    </event>
</log>
XML;
echo print_r( getTimestampsByDescription( $xml, 'Intrusion ended' ), 1 );
