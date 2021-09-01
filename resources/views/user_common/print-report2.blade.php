


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
            $institutions = json_encode($institutions); 
            $institutions = json_decode($institutions, true); 
        ?>

        <div style="font-family:Arial, Helvetica, sans-serif">
            <center style="font-size: 10px;">Regional Research, Development and Innovation Committee Database</center>
            <center style="font-size: 12px;"><b>INSTITUTIONS REPORTS</b></center>
            <center style="font-size: 10px;">Department of Science and Technology</center>
            <br>
           
        </div>

       
        <table style="width:100%; font-size: 12px; padding: 10px;">
            <thead>
                <tr>
                    <th style="width: 60%;">&nbsp;Institution</th>
                    <th style="width: 20%;">&nbsp;No. of Researcher </th>
                    <th style="width: 20%;">&nbsp;No. of Research </th>
                </tr>
            </thead>
            <tbody>
                @foreach($institutions as $data)
                    <tr class="text-center" style="font-size: 12px;">
                        <td style="margin-left: 30px;"> &nbsp;&nbsp;{{$data['name']}}</td>
                        <td><center>{{$data['researchers'] }}</center></td>
                        <td><center>{{$data['research'] }}</center></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>