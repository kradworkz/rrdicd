


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
        <center><img src="assets/images/logo-ph.png" style="width: 170px; height: auto;"></center>
        <div style="font-family: TimesNewRoman,Times New Roman,Times,Baskerville,Georgia,serif; margin-top: 10px; color: #023db0;">
            <center style="font-size: 15px;">Republic of the Philippines</center>
            <center style="font-size: 15px;">Regional Development Council IX</center>
            
        <hr style="border-top: 1px dotted #8c8b8b;"></hr>
        </div>
        <br>
        <div style="font-family:Arial, Helvetica, sans-serif">
            <center style="font-size: 10px;">Department Of Science And Technology</center>
            <center style="font-size: 12px;"><b>REGIONAL RESEARCH, DEVELOPMENT AND INNOVATION COMMITTEE</b></center>
            <!-- <center style="font-size: 10px;"><b>ATTENDANCE SHEET</b></center> -->
            <center style="font-size: 12px; margin-top: 10px;"><b>{{ strtoupper($event['name']) }}</b></center>
            <center style="font-size: 11px;">{{ $event['date'] }}, {{ $event['location'] }}</center>
            <center style="font-size: 10px;">{{ $event['type']['name'] }}</center>
            <br>

            <h5>I. ATTENDEES</h5>
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
            
            <div style="font-size: 13px; margin-top: 10px;">
                {!! str_replace("<br>","",$event['content']) !!}
            </div>
            <br>
            <p style="font-size: 13px; margin-top: 10px;"><b>HALID M. TAMANO/JUDILYN E. ALVAREZ</b></p>
            <p style="font-size: 12px; margin-top: -12px; margin-bottom: 16px;">Minutes Taker</p>
            
            <p style="font-size: 11px; margin-bottom: 5px;"><i>Certified Correct: </i></p>
            <p style="font-size: 13px; margin-top: 5px;"><b>RICARDO J. APOLINARIO</b></p>
            <p style="font-size: 12px; margin-top: -12px; margin-bottom: 16px;" >Science Research Specialist I</p>

            <p style="font-size: 11px; margin-bottom: 5px;"><i>Approved: </i></p>
            <p style="font-size: 13px; margin-top: 5px;"><b>MARTIN A. WEE</b></p>
            <p style="font-size: 12px; margin-top: -12px;" >Chair, RRDICom</p>
            <p style="font-size: 12px; margin-top: -12px; margin-bottom: 16px;" >Regional Director, DOST IX</p>
            
        </div>
    </body>
</html>
