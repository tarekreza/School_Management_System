<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    {{-- get month number and make it string --}}
    @php
        switch($month){
            case "01":
            $monthName = "january";
            break;
            case "02":
            $monthName = "February";
            break;
            case "03":
            $monthName = "March";
            break;
            case "04":
            $monthName = "April";
            break;
            case "05":
            $monthName = "May";
            break;
            case "06":
            $monthName = "June";
            break;
            case "07":
            $monthName = "July";
            break;
            case "08":
            $monthName = "August";
            break;
            case "09":
            $monthName = "September";
            break;
            case "10":
            $monthName = "October";
            break;
            case "11":
            $monthName = "November";
            break;
            case "12":
            $monthName = "December";
            break;
        }
    @endphp

    <table id="customers">
        <tr>
            <td>
                <h2>
                    School Management
                </h2>
            </td>
            <td>
                <h2>Easy School Management System</h2>
                <p>School Address</p>
                <p>Phone: 13123123123</p>
                <p>Email: tarek@mail.com</p>
                <p> <b> Employee Monthly Salary</b> </p>
            </td>
        </tr>
    </table>
    <table id="customers">
        <tr>
            <th width="10%">Sl</th>
            <th width="45%">Employee Details</th>
            <th width="45%">Employee Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Employee Name</b></td>
            <td>{{ $details['user']['name'] }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td><b>Basic Salary</b></td>
            <td>{{ $details['user']['salary'] }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td><b>Total absent in this month</b></td>
            <td>{{ $absent }}</td>
        </tr>
        <tr>
            <td>4</td>
            <td><b>Month</b></td>
            <td>{{ $monthName." ".$year }}</td>
        </tr>
        <tr>
            <td>5</td>
            <td><b>Salary of this month</b></td>
            {{-- make salary two decimal point --}}
            <td>{{ number_format($salaryofThisMonth,2) }}</td>
        </tr>
       
    </table>
    <br> <br>
    <i style="font-size: 10px; float: right;">Print Data : {{ date('d M Y') }}</i>
    <hr style="border: dashed 2px; width: 95%; color: #000000; margin-bottom: 50px">
    <table id="customers">
        <tr>
            <th width="10%">Sl</th>
            <th width="45%">Employee Details</th>
            <th width="45%">Employee Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Employee Name</b></td>
            <td>{{ $details['user']['name'] }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td><b>Basic Salary</b></td>
            <td>{{ $details['user']['salary'] }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td><b>Total absent in this month</b></td>
            <td>{{ $absent }}</td>
        </tr>
        <tr>
            <td>4</td>
            <td><b>Month</b></td>
            <td>{{ $monthName." ".$year }}</td>
        </tr>
        <tr>
            <td>5</td>
            <td><b>Salary of this month</b></td>
            {{-- make salary two decimal point --}}
            <td>{{ number_format($salaryofThisMonth,2) }}</td>
        </tr>
       
    </table>
    <br> <br>
    <i style="font-size: 10px; float: right;">Print Data : {{ date('d M Y') }}</i>
</body>

</html>
