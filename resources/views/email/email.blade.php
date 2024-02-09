<center>
    <h2>You have received an enquiry</h2>
    <br>
    <table style="border-collapse: unset; width: 80%;">
        <tbody>
        
        @foreach($data as $key => $value)
            @php
                if ( $key == '_token' || $key == 'form' ) continue;
                $value = ($key == 'attachment') ? str_replace('storage/','',$value) : $value;
                $key = ucwords( str_replace('_', ' ', $key) );
            @endphp
            @if( isset($value) && $value )
            <tr>
                <td style = "border: 1px solid #000; padding: 8px; font-weight:bold; width: 30%;">{{ $key }}:</td>
                <td style = "border: 1px solid #000; padding: 8px;">{{ $value }}</td>
            </tr>
            @endif
        @endforeach

        </tbody>
    </table>
</center>
