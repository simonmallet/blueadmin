<html>
<head>
    <link href="css/bootstrap.css" rel="stylesheet">

    <style>
        body{
            background: url("img/stardust.png");
        }

        .centered-form .panel{
            background: rgba(255, 255, 255, 0.8);
            box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
            color: #4e5d6c;
        }

        .centered-form{
            margin-top: 60px;
        }
    </style>
</head>
<body>
<div class="row centered-form">
    <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Please Login</h3>
            </div>
            <div class="panel-body">
                <form role="form">

                    <div class="form-group">
                        <input type="email" name="email" class="form-control input-sm" placeholder="Username">
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control input-sm" placeholder="Password">
                    </div>

                    <div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                        </label>
                    </div>

                    <input type="submit" value="Login" class="btn btn-info btn-block">

                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>