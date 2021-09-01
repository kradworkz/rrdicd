


<!doctype html>
<html lang="en">
    <head>
        <style>
            table, td, th {
            border: .8px solid black;
            }

            table {
            width: 100%;
            border-collapse: collapse;
            }    
            th {
                padding: 5px;
            }
            td {
                padding: 2px;
            }
        </style>
    </head>
    <body>

        <?php 
            if($type == "Researcher"){
                $ages = json_encode($ages); 
                $ages = json_decode($ages, true); 

                $qualifications = json_encode($qualifications); 
                $qualifications = json_decode($qualifications, true);

                $specialties = json_encode($specialties); 
                $specialties = json_decode($specialties, true);

                $gender = json_encode($gender); 
                $gender = json_decode($gender, true);   
            }else{
                $classifications = json_encode($classifications); 
                $classifications = json_decode($classifications, true);   

                $statuses = json_encode($statuses); 
                $statuses = json_decode($statuses, true);   
            }
        ?>

        <div style="font-family:Arial, Helvetica, sans-serif">
            <center style="font-size: 10px;">Regional Research, Development and Innovation Committee Database</center>
            <center style="font-size: 12px;"><b>RESEARCHER REPORTS</b></center>
            <center style="font-size: 10px;">Department of Science and Technology</center>
            <br>
            <center style="font-size: 13px;">{{$name}}</center>
            <center style="font-size: 12px; margin-top: 2px;"><b>Headcount of all in-house Researcher :</b> <b style="color: red;">{{ $count }}</b></center>
            <br>
        </div>

        @if($type == "Researcher")
        <table style="width:100%; font-size: 12px; padding: 10px;">
            <thead>
                <tr>
                    <th style="width: 70%;">&nbsp;</th>
                    <th style="width: 30%;">&nbsp;No. of Researchers </th>
                </tr>
            </thead>
            <tbody>
                <tr style="background-color:#86ff95;">
                    <td colspan="2"><b>1.1 Sex</b></td>
                </tr>
                @foreach($gender as $data)
                    <tr class="text-center" style="font-size: 12px;">
                        <td style="margin-left: 30px;"> &nbsp;&nbsp;{{$data['name']}}</td>
                        <td><center>{{$data['count'] }}</center></td>
                    </tr>
                @endforeach
                <tr style="background-color:#86ff95;">
                    <td colspan="2"><b>1.1.2 Highest Qualification</b></td>
                </tr>
                @foreach($qualifications as $data)
                    <tr class="text-center" style="font-size: 12px;">
                        <td style="margin-left: 30px;">&nbsp;&nbsp;{{$data['name']}}</td>
                        <td><center>{{$data['count'] }}</center></td>
                    </tr>
                @endforeach
                <tr style="background-color:#86ff95;">
                    <td colspan="2"><b>1.1.3 Field of Science and Technology</b></td>
                </tr>
                @foreach($specialties as $data)
                    <tr class="text-center" style="font-size: 12px;">
                        <td style="margin-left: 30px;">&nbsp;&nbsp;{{$data['name']}}</td>
                        <td><center>{{$data['count'] }}</center></td>
                    </tr>
                @endforeach
                <tr style="background-color:#86ff95;">
                    <td colspan="2"><b>1.1.4 Age Group</b></td>
                </tr>
                @foreach($ages as $data)
                    <tr class="text-center" style="font-size: 12px;">
                        <td style="margin-left: 30px;">&nbsp;&nbsp;{{$data['name']}}</td>
                        <td><center>{{$data['count'] }}</center></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else 
        <table style="width:100%; font-size: 12px; padding: 10px;">
            <thead>
                <tr>
                    <th style="width: 70%;">&nbsp;</th>
                    <th style="width: 30%;">&nbsp;No. of Research </th>
                </tr>
            </thead>
            <tbody>
                <tr style="background-color:#86ff95;">
                    <td colspan="2"><b>1.1 Classifications</b></td>
                </tr>
                @foreach($classifications as $data)
                    <tr class="text-center" style="font-size: 12px;">
                        <td style="margin-left: 30px;"> &nbsp;&nbsp;{{$data['name']}}</td>
                        <td><center>{{$data['count'] }}</center></td>
                    </tr>
                @endforeach
                <tr style="background-color:#86ff95;">
                    <td colspan="2"><b>1.1.2 Statuses</b></td>
                </tr>
                @foreach($statuses as $data)
                    <tr class="text-center" style="font-size: 12px;">
                        <td style="margin-left: 30px;">&nbsp;&nbsp;{{$data['name']}}</td>
                        <td><center>{{$data['count'] }}</center></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </body>
</html>