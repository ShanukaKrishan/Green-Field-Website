<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
</head>
<body>
<style>

    /* Optional: Makes the sample page fill the window. */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        background-size: 100%, 100%;
    }

    #list{
        float: left;
        width:25%;

    }
    #map {
        float:right;
        height: 100%;
        width: 75%;
    }
     #img_div
{
   
    padding: 5px;
    margin: 15px auto;
    border:1px solid #cbcbcb;
    overflow-y: scroll;
    overflow-x: hidden;
    height: 120px;

}
img {
        float: left;
    height: 100px;
    width: 100px;
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
