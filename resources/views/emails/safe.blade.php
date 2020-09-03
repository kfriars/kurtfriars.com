<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" message-id="{{ $messageId ?? \Illuminate\Support\Str::random(25) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('common.flowcates') }} - {{ $subject }}</title>
    <style type="text/css">
        /* Template styling */

        body {
            width: 100%;
            max-width: 100%;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 17px;
            line-height: 24px;
            color: #343434;
            background: #F5F6F7;
        }

        h1,
        h2,
        h3,
        h4 {
            color: #2ab27b;
            line-height: 26px;
            margin-bottom: 12px;
        }

        p,
        ul,
        ul li {
            font-size: 17px;
            margin: 0 0 16px;
            line-height: 24px;
        }

        ul {
            margin-bottom: 24px;
        }

        ul li {
            margin-bottom: 8px;
        }

        p.mini {
            font-size: 12px;
            line-height: 18px;
            color: #ABAFB4;
        }

        p.message {
            font-size: 16px;
            line-height: 20px;
            margin-bottom: 4px;
        }

        hr {
            margin: 2rem 0;
            width: 100%;
            border: none;
            border-bottom: 1px solid #ECECEC;
        }

        a,
        a:link,
        a:visited,
        a:active,
        a:hover {
            font-weight: bold;
            color: #ed8936;
            text-decoration: none;
            word-break: break-word;
        }

        a:active,
        a:hover {
            text-decoration: underline;
        }

        .time {
            font-size: 11px;
            color: #ABAFB4;
            padding-right: 6px;
        }

        .emoji {
            vertical-align: bottom;
        }

        .avatar {
            border-radius: 2px;
        }

        #footer p {
            margin-top: 16px;
            font-size: 12px;
        }

        /* Client-specific Styles */

        #outlook a {
            padding: 0;
        }

        body {
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0 auto;
            padding: 0;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }

        #backgroundTable {
            margin: 0;
            padding: 0;
            width: 100%;
            line-height: 100% !important;
        }

        /* Some sensible defaults for images
		Bring inline: Yes. */

        img {
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        a img {
            border: none;
        }

        .image_fix {
            display: block;
        }

        /* Outlook 07, 10 Padding issue fix
		Bring inline: No.*/

        table td {
            border-collapse: collapse;
        }

        /* Fix spacing around Outlook 07, 10 tables
	    Bring inline: Yes */

        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        /* Mobile */

        @media only screen and (max-device-width: 480px) {
            /* Part one of controlling phone number linking for mobile. */
            a[href^="tel"],
            a[href^="sms"] {
                text-decoration: none;
                color: #1a202c;
                /* or whatever your want */
                pointer-events: none;
                cursor: default;
            }

            .mobile_link a[href^="tel"],
            .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: #ed8936 !important;
                pointer-events: auto;
                cursor: default;
            }

        }

        /* Not all email clients will obey these, but the important ones will */

        @media only screen and (max-width: 480px) {
            .card {
                padding: 1rem 0.75rem !important;
            }
            .link_option {
                font-size: 14px;
            }
            hr {
                margin: 2rem -0.75rem !important;
                padding-right: 1.5rem !important;
            }
        }

        /* More Specific Targeting */

        @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
            /* You guessed it, ipad (tablets, smaller screens, etc) */
            /* repeating for the ipad */
            a[href^="tel"],
            a[href^="sms"] {
                text-decoration: none;
                color: #1a202c;
                /* or whatever your want */
                pointer-events: none;
                cursor: default;
            }

            .mobile_link a[href^="tel"],
            .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: #ed8936 !important;
                pointer-events: auto;
                cursor: default;
            }
        }

        /* iPhone Retina */

        @media only screen and (-webkit-min-device-pixel-ratio: 2) and (max-device-width: 640px) {
            /* Must include !important on each style to override inline styles */
            #footer p {
                font-size: 9px;
            }
        }

        /* Android targeting */

        @media only screen and (-webkit-device-pixel-ratio:.75) {
            /* Put CSS for low density (ldpi) Android layouts in here */
            img {
                max-width: 100%;
                height: auto;
            }
        }

        @media only screen and (-webkit-device-pixel-ratio:1) {
            /* Put CSS for medium density (mdpi) Android layouts in here */
            img {
                max-width: 100%;
                height: auto;
            }
        }

        @media only screen and (-webkit-device-pixel-ratio:1.5) {
            /* Put CSS for high density (hdpi) Android layouts in here */
            img {
                max-width: 100%;
                height: auto;
            }
        }

        /* Galaxy Nexus */

        @media only screen and (min-device-width: 720px) and (max-device-width: 1280px) {
            img {
                max-width: 100%;
                height: auto;
            }
            body {
                font-size: 16px;
            }
        }

        /* end Android targeting */

        /* Not all email clients will obey these, but the important ones will */

        @media only screen and (max-width: 480px) {
            .graph_image {
                width: 90% !important;
            }
        }
        
        @yield ('styles')
    </style>
</head>

<body style="background: #F5F6F7; color: #343434; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 17px; line-height: 24px; max-width: 100%; width: 100% !important; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; margin: 0 auto; padding: 0;">
    <!--[if mso]>
		<style type="text/css">
			
			td { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important; }
			
		</style>
	<![endif]-->


    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; line-height: 24px; margin: 0; padding: 0; width: 100%; font-size: 17px; color: #343434; background: #F5F6F7;">
        <tr>
            <td valign="top" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif !important; border-collapse: collapse;">

                @if (!empty($marketingLink))
                <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#1a202c" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                    <tr>
                        <td valign="bottom" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif !important; border-collapse: collapse; padding: 20px 16px 8px;">
                            <div style="text-align: center; color: #FFFFFF; font-size: 17px; font-weight: normal; line-height: 20px;">

                                <p style="font-size: 17px; line-height: 24px; margin: 0 0 16px;">{{ $marketingTagline }}
                                    <br>
                                    <a href="{{ $marketingLink }}" style="color: #FFFFFF; font-weight: bold; text-decoration: underline; word-break: break-word;">{{ $marketingLinkText }}</a>
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
                @endif
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                    <tr>
                        <td valign="bottom" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif !important; border-collapse: collapse; padding: 20px 16px 12px;">
                            <div style="text-align: center;">
                                <a href="{{ url('/') }}" style="color: #ed8936; font-weight: bold; text-decoration: none; word-break: break-word;">
                                    <img src="{{ asset( 'images/logo/logo-black.png' ) }}" width="80"
                                        style="-ms-interpolation-mode: bicubic; outline: none; text-decoration: none; border: none; margin-left: -1.5rem;">
                                </a>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif !important; border-collapse: collapse;">
                @yield('content')
            </td>
        </tr>
        <tr>
            <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif !important; border-collapse: collapse;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin-top: 1rem; background: white; color: #989EA6;">
                    <tr>
                        <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif !important; border-collapse: collapse; height: 5px; background-color: #1a202c; background-repeat: repeat-x; background-size: auto 5px;"></td>
                    </tr>
                    <tr>
                        <td valign="top" align="center" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif !important; border-collapse: collapse; padding: 16px 8px 24px;">
                            <div style="max-width: 600px; margin: 0 auto;">
                                @if(!empty($safe_href) && !empty($safe_button))
                                    <p style="font-size: 12px; line-height: 20px; margin: 0 0 16px; margin-top: 16px;">
                                    {{ __('email/common.trouble_clicking', ['button' => $safe_button]) }} <a href="{{ $safe_href }}" style="color: #ed8936; font-weight: bold; text-decoration: none; word-break: break-word;">{{ __('common.link') }}</a>
                                    </p>
                                @endif
                                <p style="font-size: 12px; line-height: 20px; margin: 0 0 16px; margin-top: 16px;">
                                    <span style="max-width: 380px; display: block;">
                                        @if($canUnscubscribe ?? false)
                                        {{ __('email/common.unsubscribe_message') }}
                                        <a style="color:#ed8936;" href="{{ $unsubscribeUrl }}">
                                            {{ __('email/common.unsubscribe') }}
                                        </a>.
                                        @endif
                                    </span>
                                </p>
                                <p style="font-size: 12px; line-height: 20px; margin: 0 0 16px; margin-top: 16px;">
                                    <a href="{{ url('/') }}" style="color: #ed8936; font-weight: bold; text-decoration: none; word-break: break-word;">kurtfriars.com</a>
                                    •
                                    <a href="{{ url('/cv') }}" style="color: #ed8936; font-weight: bold; text-decoration: none; word-break: break-word;">{{ __('email/common.cv') }}</a>
                                    <br>
                                    <a href="#" style="color: #989EA6; font-weight: normal; text-decoration: none; word-break: break-word; pointer-events: none;">
                                        Guelph, ON, Canada
                                    </a>
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>