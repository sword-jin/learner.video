<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>{{ $newsletter->title }}</title>
  </head>
  <body>
    <table id="lbt" style="border-collapse: collapse; height: 100% !important; margin: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0; table-layout: fixed; width: 100% !important" border="0" cellpadding="0" cellspacing="0" align="center" height="100%" width="100%">
      <tbody>
        <tr>
          <td id="lbc" style="height: 100% !important; margin: 0; padding: 0; vertical-align: top; width: 100% !important" align="center" valign="top">
            <table style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; table-layout: fixed" border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
              <tbody>
                <tr>
                  <td id="h" style="background: #ffffff; color: #b8b8b8; vertical-align: top" align="center" bgcolor="#ffffff" valign="top">
                    <table class="lc" style="border-collapse: collapse; max-width: 600px; mso-table-lspace: 0pt; mso-table-rspace: 0pt; table-layout: fixed" border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
                      <tbody>
                        <tr>
                          <td class="h" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; font-size: 13px; line-height: 21px; padding: 10px 20px 20px; text-align: center; vertical-align: top" align="center" valign="top">
                            <div class="hs" style="-moz-osx-font-smoothing: grayscale; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #b8b8b8; font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif !important; font-size: 12px; line-height: 16px"></div>
                            <div class="s" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #b8b8b8; font-size: 18px; line-height: 18px; mso-line-height-rule: exactly">&nbsp;</div>
                            <h1 class="hl" style="-moz-osx-font-smoothing: grayscale; -webkit-font-smoothing: antialiased; color: #b8b8b8; display: block !important; font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif !important; font-size: 26px; font-weight: 400; line-height: 36px; margin: 0; padding: 0">
                              <img alt="learner.video" src="{{ asset('img/logo.png') }}" style="-ms-interpolation-mode: bicubic; border: 0; font-size: 30px; line-height: 30px; max-width: 100%; outline: none; text-align: center; text-decoration: none" width="50">
                            </h1>
                            <div class="s" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; color: #b8b8b8; font-size: 18px; line-height: 18px; mso-line-height-rule: exactly">&nbsp;</div>
                            <div class="ha" style="-moz-osx-font-smoothing: grayscale; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #b8b8b8; font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif !important; font-size: 13px; line-height: 21px">
                              <a href="{{ route('home') }}" style="color: #b8b8b8; mso-line-height-rule: exactly; text-decoration: none">learner.video</a>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top" align="center" valign="top">
                    <table class="lc" style="border-collapse: collapse; max-width: 600px; mso-table-lspace: 0pt; mso-table-rspace: 0pt; table-layout: fixed" border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
                      <tbody>
                        <tr>
                          <td class="hi" style="font-size: 16px; line-height: 21px; padding: 30px 20px; vertical-align: top" align="center" valign="top">
                            <h2 style="-moz-osx-font-smoothing: grayscale; -webkit-font-smoothing: antialiased; color: #454547; display: block !important; font-family: 'Merriweather', Georgia, 'Times New Roman', Times, serif !important; font-size: 16px; font-weight: 400; line-height: 21px; margin: 0; padding: 0">
                              {{ $newsletter->title }} &nbsp;
                              <i style="color: #77777b;">{{ timeToDate($newsletter->updated_at) }}</i>
                            </h2>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <?php foreach ($newsletter->links as $link): ?>
                  <tr>
                    <td class="c" id="cc-linksoftheweek" style="background: #FFFFFF; color: #454547; padding-left: 20px; padding-right: 20px; vertical-align: top" align="center" bgcolor="#FFFFFF" valign="top">
                      <table class="lc" style="border-collapse: collapse; margin-bottom: 22px; max-width: 600px; mso-table-lspace: 0pt; mso-table-rspace: 0pt; table-layout: fixed" border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
                        <tbody>
                          <tr>
                            <td style="vertical-align: top" align="center" valign="top">
                              <table style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; table-layout: fixed" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                  <tr>
                                    <td style="vertical-align: top" valign="top">
                                      <div class="s" style="font-size: 26px; line-height: 26px; mso-line-height-rule: exactly">&nbsp;</div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="vertical-align: top" valign="top">
                                      <div class="s" style="font-size: 26px; line-height: 26px; mso-line-height-rule: exactly">&nbsp;</div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="ci" style="color: #454547; text-align: left; vertical-align: top" align="left" valign="top">
                                      <h2 class="cit" style="-moz-osx-font-smoothing: grayscale; -webkit-font-smoothing: antialiased; display: block !important; font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif !important; font-size: 22px; font-weight: 700; line-height: 28px; margin: 0 0 10px; padding: 0; text-rendering: optimizeLegibility">
                                        <a href="{{ $link->link }}" style="color: #000000; mso-line-height-rule: exactly; text-decoration: none">{{ $link->title }}</a>
                                      </h2>
                                      <p style="-moz-osx-font-smoothing: grayscale; -webkit-font-smoothing: antialiased; font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif !important; font-size: 18px; font-weight: 400; line-height: 26px; margin: 0 0 20px; mso-line-height-rule: exactly; text-rendering: optimizeLegibility">
                                        {{ $link->note }}
                                      </p>
                                      <p class="cif" style="-moz-osx-font-smoothing: grayscale; -webkit-font-smoothing: antialiased; color: #454547; font-family: 'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif !important; font-size: 14px; font-style: italic; font-weight: 400; line-height: 22px; margin: -10px 0 0; mso-line-height-rule: exactly; text-rendering: optimizeLegibility">
                                        <a href="{{ $link->domain }}" style="color: #000000; mso-line-height-rule: exactly; text-decoration: none">{{ $link->domain }}</a>
                                      </p>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="cihr" style="mso-line-height-rule: exactly; padding-bottom: 26px; vertical-align: top" align="center" valign="top">
                                      <hr style="background: #cccccc; border: 0; color: #cccccc; font-size: 4px; height: 1px; line-height: 4px; margin: 0; text-algin: center; width: 55px">
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
