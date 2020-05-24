<tr>
    <td style="padding: 20px 50px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
      <h1 style="margin: 0 0 10px; font-size: 20px; line-height: 30px; color: #8b572a; font-weight: normal;">Hai,<strong>{{$user['full_name']}}</strong> </h1>
        <p style="margin: 0 0 10px; line-height:24px;">Berikut tautan untuk masuk kembali ke halaman website:</p>
        <p style="margin: 0 0 10px; line-height:24px;"><a href="{{$token}}" style="color:#8b572a;">{{$token}}</a></p>
        <p style="margin: 0 0 10px; line-height:24px;">Silahkan klik tautan untuk mengubah kata sandi Anda.</p>
      </td>
  </tr>
