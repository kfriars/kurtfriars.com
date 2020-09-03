@extends('emails.safe')

@section('content')
<table cellpadding="32" cellspacing="0" border="0" align="center" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: white; border-radius: 0.5rem; margin-bottom: 1rem;">
    <tr>
        <td width="546" valign="top" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif !important; border-collapse: collapse;">
            <div style="max-width: 600px; margin: 0 auto;">
                <h1 style="color: #3C5158; line-height: 30px; margin-bottom: 12px; margin: 0 auto 0.75rem; font-size: 2.0rem; text-align: center;">
                    {{ $title }}
                </h1>
                <h3 style="color: #343434; line-height: 26px; margin-bottom: 2rem; font-size: 1.0rem; text-align: center; margin: 0 auto 1rem;">
                    {{ $featureText }}
                </h3>
                @foreach ($elements as $element)
                    @include('emails.elements.'.$element['type'])
                @endforeach
            </div>
        </td>
    </tr>
</table>
@endsection