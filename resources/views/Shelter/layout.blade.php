<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shelter</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


    <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('style.js') }}">


    </head>
<style>
    body{
        margin-left: 100px;
    margin-top:300px;
    }

    .rounded {
    -webkit-border-radius: 3px !important;
    -moz-border-radius: 3px !important;
    border-radius: 3px !important;
    }

    .mini-stat {
    padding: 15px;
    margin-bottom: 20px;
    }

    .mini-stat-icon {
    width: 60px;
    height: 60px;
    display: inline-block;
    line-height: 60px;
    text-align: center;
    font-size: 30px;
    background: none repeat scroll 0% 0% rgb(57, 115, 182);
    border-radius: 100%;
    float: left;
    margin-right: 10px;
    color: #FFF;
    }

    .mini-stat-info {
    font-size: 12px;
    padding-top: 2px;
    }

    span, p {
    color: white;
    }

    .mini-stat-info span {
    display: block;
    font-size: 30px;
    font-weight: 600;
    margin-bottom: 5px;
    margin-top: 7px;
    }

    /* ================ colors =====================*/
    .bg-animal {
    background-color: #3b5998 !important;
    border: 1px solid #3b5998;
    color: white;
    }

    .fg-animal {
    color: #3b5998 !important;
    }

    .bg-twitter {
    background-color: #00a0d1 !important;
    border: 1px solid #00a0d1;
    color: white;
    }

    .fg-twitter {
    color: #00a0d1 !important;
    }

    .bg-googleplus {
    background-color: #db4a39 !important;
    border: 1px solid #db4a39;
    color: white;
    }

    .fg-googleplus {
    color: #db4a39 !important;
    }

    .bg-bitbucket {
    background-color: #205081 !important;
    border: 1px solid #205081;
    color: white;
    }

    .fg-bitbucket {
    color: #205081 !important;
    }
    </style>

    <body>
        @include('inc.sidebar')

    <div class="container">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="mini-stat clearfix bg-animal rounded">
                <span class="mini-stat-icon"><i class="fa fa-paw" ></i></span>
                <div class="mini-stat-info">
                    <span>{{ $animalcount }}</span>
                    Animals
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="mini-stat clearfix bg-twitter rounded">
                <span class="mini-stat-icon"><i class="fa fa-twitter fg-twitter"></i></span>
                <div class="mini-stat-info">
                    <span>{{ $adopterscount }}</span>
                    Adopters
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="mini-stat clearfix bg-googleplus rounded">
                <span class="mini-stat-icon"><i class="fa fa-google-plus fg-googleplus"></i></span>
                <div class="mini-stat-info">
                    <span>{{ $rescuercount }}</span>
                  Rescuers
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="mini-stat clearfix bg-bitbucket rounded">
                <span class="mini-stat-icon"><i class="fa fa-bitbucket fg-bitbucket"></i></span>
                <div class="mini-stat-info">
                    <span>{{ $personnelcount }}</span>
                    Personnels
                </div>
            </div>
        </div>
	</div>
</div>
    </div>

    </body>
</html>
