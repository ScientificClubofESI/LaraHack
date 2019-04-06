<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html style="margin: 0;padding: 0;" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width">
    <meta name="robots" content="noindex,nofollow">
    <!-- Begin Styles Section  -->
    @include('emails.layouts.styles')

    <!-- End Styles Section -->
</head>

<body class="full-padding" cz-shortcut-listen="true">
    <table class="wrapper" cellpadding="0" cellspacing="0" role="presentation">
        <tbody>
            <tr>
                <td>
                    <div class="layout one-col fixed-width container">
                        <div class="layout__inner first-section">
                            <div class="column custom-column">

                                <div style="margin:30px 20px 40px 20px;">
                                    <p class="title">
                                        <img src="{{ $message->embed(public_path() . '/images/LOGO.png') }}" width="150" />
                                    </p>
                                </div>
                                <div style="margin:30px 20px 40px 20px;">
                                    <p class="title">
                                        @yield('title')
                                    </p>
                                </div>
                                <div style="margin-left: 20px;margin-right: 20px;">
                                    <p class="desc">
                                        @yield('desc')
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="layout one-col fixed-width container">
                        <div class="layout__inner container-details" emb-background-style="">
                            <div class="column custom-column">
                                <div style="Margin-left: 20px;margin-right: 20px;margin-bottom: 24px;margin-top: 30px;">
                                    <p>
                                        Hi ,
                                    </p>

                                    <p>
                                        @yield('first')
                                    </p>

                                    <p>
                                        @yield('second')
                                    </p>
                                    <p>For any questions, please visit our FAQ on our website or don't hesitate to contact us
                                        at cse@esi.dz .
                                    </p>

                                    <p class="button-container">
                                        @yield('button')
                                    </p>


                                </div>
                            </div>
                        </div>
                    </div>
    @include('emails.layouts.social')
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>