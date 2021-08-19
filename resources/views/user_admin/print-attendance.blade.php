


<!doctype html>
<html lang="en">
    <head>
        <style>
            table, td, th {
            border: .8px solid black;
            text-align: center;
            }

            table {
            width: 100%;
            border-collapse: collapse;
            }    
        </style>
    </head>
    <body data-topbar="dark" data-layout="horizontal">

        <?php 
            $test = json_encode($members); 
            $res = json_decode($test, true); 
            $event = json_encode($event); 
            $event = json_decode($event, true); 
        ?>

        <div style="font-family:Arial, Helvetica, sans-serif">
            <center style="font-size: 10px;">Department Of Science And Technology</center>
            <center style="font-size: 12px;"><b>REGIONAL RESEARCH, DEVELOPMENT AND INNOVATION COMMITTEE</b></center>
            <center style="font-size: 10px;"><b>ATTENDANCE SHEET</b></center>
            <br>
            <center style="font-size: 12px;"><b>{{ strtoupper($event['name']) }}</b></center>
            <center style="font-size: 11px;">{{ $event['date'] }}</center>
            <center style="font-size: 10px;">{{ $event['type']['name'] }}</center>
            <br>

          
            <table class="table table-centered table-nowrap mb-0">
                <thead class="thead-light">
                    <tr class="text-center" style="font-size: 10px;">
                        <th style="width: 25%;">Name</th>
                        <th style="width: 35%;">Agency</th>
                        <th style="width: 20%;">Representative</th>
                        <th style="width: 20%;">Date</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($res as $data)
                    <tr class="text-center" style="font-size: 10px;">
                        
                        <td style="font-size: 9px;">{{$data['name']}}</td>
                        <td style="font-size: 8px;">{{ (strlen($data['institution']) > 40) ? $data['acronym'] : $data['institution'] }} </td>
                        <td style="font-size: 9px;">{{$data['representative']}}</td>
                        <td style="font-size: 8px;">{{$data['created_at']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </body>
</html>
