<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Settly - Weekly Client List</title>
    <style type="text/css">
        img {
            max-width: 600px;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        a img {
            border: none;
        }

        table {
            border-collapse: collapse !important;
        }

        #outlook a {
            padding: 0;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        .backgroundTable {
            margin: 0 auto;
            padding: 0;
            width: 100% !important;
        }

        table td {
            border-collapse: collapse;
        }

        .ExternalClass * {
            line-height: 115%;
        }

        td {
            font-family: Arial, sans-serif;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100%;
            height: 100%;
            color: #6f6f6f;
            font-weight: 400;
            font-size: 18px;
        }

        h1 {
            margin: 10px 0;
        }

        a {
            color: #27aa90;
            text-decoration: none;
        }

        .force-full-width {
            width: 100% !important;
        }

        .body-padding {
            padding: 0 75px;
        }

        .force-width-80 {
            width: 80% !important;
        }

    </style>
    <style type="text/css" media="screen">
        @media screen {
            @import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,900);

            * {
                font-family: 'Source Sans Pro', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
            }

            .w280 {
                width: 280px !important;
            }
        }

    </style>
</head>

<body offset="0" class="body"
    style="padding:0; margin:0; display:block; background:#eeebeb; -webkit-text-size-adjust:none" bgcolor="#eeebeb">
    <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
        <tr>
            <td align="center" valign="top" style="background-color:#eeebeb" width="100%">
                <center>
                    <table cellspacing="0" cellpadding="0" width="600" class="w320" style="margin-top: 30px;">
                        <tr>
                            <td align="center" valign="top">
                                <table cellspacing="0" cellpadding="0" bgcolor="#363636" class="force-full-width">
                                    <tr>
                                        <td style="background-color:#363636; text-align:center;">
                                            <br>
                                            <h1 style="color:#eeebeb">Settly - Weekly Client List</h1>
                                            <br>
                                        </td>
                                    </tr>
                                </table>
                                <table cellspacing="0" cellpadding="0" width="100%" style="background-color:#3bcdb0;">
                                    <tr>
                                        <td style="background-color:#3bcdb0;">
                                            <table cellspacing="0" cellpadding="0" width="100%">
                                                <tr>
                                                    <td
                                                        style="font-size:30px; font-weight: 600; color: #ffffff; text-align:center;">
                                                        <br>
                                                        Here is a copy of all clients
                                                        <br>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellspacing="0" cellpadding="0" width="100%">
                                                <tr>
                                                    <td>
                                                        <img src="https://imgur.com/zaFK3s7.gif"
                                                            style="max-width:100%; display:block;">
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table cellspacing="0" cellpadding="0" class="force-full-width" bgcolor="#ffffff">
                                    <tr>
                                        <td style="background-color:#ffffff;">
                                            <br><br>
                                            <center>
                                                <table style="margin: 0 auto;" cellspacing="0" cellpadding="0"
                                                    class="force-width-80">
                                                    <tr>
                                                        <td style="text-align:left; color: #6f6f6f;">
                                                            <br>
                                                            Hi, <b>Settly Admin</b><br><br>
                                                            These are the lists of clients registered:<br>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <br><br>
                                                <table style="margin: 0 auto;" cellspacing="0" cellpadding="0"
                                                    class="force-width-80">
                                                    @foreach ($clients as $client)
                                                        <tr>
                                                            <td
                                                                style="text-align:left; color: #6f6f6f; padding-right:10px;">
                                                                {{ $loop->index + 1 }}
                                                            </td>
                                                            <td style="text-align:left; color: #6f6f6f;">
                                                                {{ $client['first_name'] }}
                                                            </td>
                                                            <td style="text-align:left; color: #6f6f6f;">
                                                                {{ $client['last_name'] }}
                                                            </td>
                                                            <td style="text-align:left; color: #6f6f6f;">
                                                                {{ $client['email'] }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                                <br>
                                                <br>
                                            </center>
                                            <table cellspacing="0" cellpadding="0" bgcolor="#363636"
                                                class="force-full-width">
                                                <tr>
                                                    <td style="background-color:#363636; text-align:center;">
                                                        <br>
                                                        <br>
                                                        <br>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </center>
            </td>
        </tr>
    </table>
</body>

</html>
