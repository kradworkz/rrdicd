


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
        </style>
    </head>
    <body>

        <?php 
            $researcher = json_encode($researcher); 
            $researcher = json_decode($researcher, true); 
        ?>

        <div style="font-family:Arial, Helvetica, sans-serif">
            <center style="font-size: 10px;">Regional Research, Development and Innovation Committee Database</center>
            <center style="font-size: 12px;"><b>INDIVIDUAL RESEARCH PROFILE</b></center>
            <center style="font-size: 10px;">Department of Science and Technology</center>
            <br>

            <h6 style="margin-bottom: 0px; margin-top: 2px;">Profile Information</h6>
            <table style="width:100%; font-size: 10px;">
               
                <tr>
                    <td style="width: 15%;">&nbsp;Name: </td>
                    <td style="width: 45%; border-left-style: hidden;">{{ $researcher['lastname']}}, {{ $researcher['firstname'] }} {{ $researcher['middlename'] }}.</td>
                    <td style="width: 15%;">&nbsp;Email Address: </td>
                    <td style="width: 25%; border-left-style: hidden;">{{ $researcher['email']}}</td>
                </tr>
                <tr>
                    <td style="width: 15%;">&nbsp;Institution: </td>
                    <td style="width: 45%; border-left-style: hidden;">{{ $researcher['institution']['name']}}</td>
                    <td style="width: 15%;">&nbsp;Contact: </td>
                    <td style="width: 25%; border-left-style: hidden;">{{ $researcher['mobile']}}</td>
                </tr>
                <tr>
                    <td style="width: 15%;">&nbsp;Designation: </td>
                    <td style="width: 45%; border-left-style: hidden;">{{ $researcher['designation']['name']}}</td>
                    <td style="width: 15%;">&nbsp;Gender: </td>
                    <td style="width: 25%; border-left-style: hidden;">{{ $researcher['gender']}}</td>
                </tr>
                <tr>
                    <td style="width: 30%;">&nbsp;Field of Science and Technology: </td>
                    <td style="width: 25%; border-left-style: hidden;">{{ $researcher['specialty']['name']}}</td>
                    <td style="width: 15%;">&nbsp;Age: </td>
                    <td style="width: 30%; border-left-style: hidden;">{{ $researcher['birthdate']}}</td>
                </tr>
            </table>

            <br>
            <h6 style="margin-bottom: 0px; margin-top: 2px;">Education</h6>
            <table class="table table-centered table-nowrap mb-0">
                <thead class="thead-light">
                    <tr class="text-center" style="font-size: 9px;">
                        <th style="width: 20%;">Year Graduated</th>
                        <th style="width: 40%;">Institution</th>
                        <th style="width: 20%;">Program/Degree</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($researcher['educations'] as $data)
                    <tr class="text-center" style="font-size: 10px;">
                        
                        <td style="font-size: 10px;"><center>{{$data['year']}}</center></td>
                        <td style="font-size: 10px;"><center>{{$data['institution']}}</center> </td>
                        <td style="font-size: 10px;"><center>{{$data['program']}}</center></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <br>
            <h6 style="margin-bottom: 0px; margin-top: 2px;">Publications</h6>
            <table class="table table-centered table-nowrap mb-0">
                <thead class="thead-light">
                    <tr class="text-center" style="font-size: 9px;">
                        <th style="width: 20%;">Year Published</th>
                        <th style="width: 40%;">Title</th>
                        <th style="width: 20%;">Brief Description</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($researcher['publications'] as $data)
                    <tr class="text-center" style="font-size: 10px;">
                        
                        <td style="font-size: 10px;"><center>{{$data['published']}}</center></td>
                        <td style="font-size: 10px;"><center>{{$data['title']}}</center> </td>
                        <td style="font-size: 10px;"><center>{{$data['description']}}</center></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <br>
            <h6 style="margin-bottom: 0px; margin-top: 2px;">Trainings related to Research</h6>
            <table class="table table-centered table-nowrap mb-0">
                <thead class="thead-light">
                    <tr class="text-center" style="font-size: 9px;">
                        <th style="width: 20%;">Date</th>
                        <th style="width: 40%;">Title</th>
                        <th style="width: 20%;">Venue</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($researcher['trainings'] as $data)
                    <tr class="text-center" style="font-size: 10px;">
                        
                        <td style="font-size: 10px;"><center>{{$data['date']}}</center></td>
                        <td style="font-size: 10px;"><center>{{$data['title']}}</center> </td>
                        <td style="font-size: 10px;"><center>{{$data['venue']}}</center></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

         
        </div>
    </body>
</html>