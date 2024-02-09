<center>
    <h2>Order in Web Hook</h2>
    <br>
    <table style="border-collapse: unset; width: 80%;">
        <tbody>
        
            @foreach($data as $key => $value)
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

