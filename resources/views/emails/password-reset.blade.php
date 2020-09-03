@extends('emails.safe')

@section('content')
<?php $lang = 'emails/mail.password_reset'; ?>
<table cellpadding="32" cellspacing="0" border="0" align="center" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: white; border-radius: 0.5rem; margin-bottom: 1rem;">
    <tr>
        <td width="546" valign="top" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif !important; border-collapse: collapse;">
            <div style="max-width: 600px; margin: 0 auto;">
                <h1 style="color: #3C5158; line-height: 30px; margin-bottom: 12px; margin: 0 auto 0.75rem; font-size: 2.0rem; text-align: center;">
                    {{ __("$lang.title") }}
                </h1>
                <h3 style="color: #343434; line-height: 26px; margin-bottom: 2rem; font-size: 1.0rem; text-align: center; margin: 0 auto 1rem;">
                    {{ __("$lang.description") }}
                </h3>
                <hr style="border: none; border-bottom: 1px solid #ECECEC; margin: 1.5rem 0; width: 100%;">
                <p style="font-size: 17px; line-height: 24px; margin: 0 0 16px;"><strong>{{ $body_header }}</strong></p>
                
                @foreach($intro as $p)
                <p style="font-size: 17px; line-height: 24px; margin: 0 0 16px;">{{ $p }}</p>
                @endforeach

                @if (!empty($bullets))
                <hr style="border: none; border-bottom: 1px solid #ECECEC; margin: 1.5rem 0; width: 100%;">
                <p style="font-size: 17px; line-height: 24px; margin: 0 0 16px;"><strong>{{ $bullets_heading }}</strong></p>

                @foreach ($bullets as $bullet)
                <div style="padding-left:1.5rem;margin-bottom:16px;line-height:24px">
                    <img src="{{ mail_asset('images/email/arrow-bullet.png') }}" width="18" height="18" style="outline:none;text-decoration:none;width:18px;float:left;margin-top:3px;margin-right:1rem" class="CToWUd">
                    <span style="display:block;margin-left:2.1rem">
                        {{ $bullet }}
                    </span>
                </div>
                @endforeach
                @endif
                
                <center>
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td style="width: 40%">&nbsp;</td>
                                <td align="center" style="width: 20%">
                                    <table border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
                                        <tr>
                                            <td align="center" bgcolor="transparent" width="150" style="-moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;">
                                                <a href="{{ $bottom_href }}" style="padding: 10px;width:150px;display: block;text-decoration: none;border:0;text-align: center;font-weight: bold;font-size: 15px;font-family: sans-serif;color: #25A2E1;background-color: #FFFFFF;border: 1px solid #25A2E1;-moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;line-height:17px;">
                                                    {{ $bottom_button }}
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 40%">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </center>
            </div>
        </td>
    </tr>
</table>
@endsection
