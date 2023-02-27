<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

   <div class="container">
      <div class="col-md-10 m-auto">
       
          <div class="col-xl-10 m-auto">
            <div class="card-body card-adjust bg-white pb-4">
            <h5 style=" font-size:15px;font-style:bold;margin-left:30px;">Hello {{$name}}</h5>
              <p style="margin-left:30px; font-size:15px;"> Your Login Credentials is : <br> Email ID : {{$email}} <br> Password : {{$password}} </p>
             <h5 style=" font-size:15px;
                  font-style:bold;margin-left:30px;">
                Thanks & Regards <br>
                Laravel
             </h5>
          </div>
         </div>
      </div>
    </div>
   </body>
  </html>