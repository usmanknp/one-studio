<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Testing</title>
    <style>
        @page { size: A4; margin: 10mm;}
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }
        a {
            color: #0087C3;
            text-decoration: none;
        }
        body {
            position: relative;
            width: 100%;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        header {
            padding: 0;
            margin-bottom: 10px;
            /*border-bottom: 1px solid #AAAAAA;*/
        }
        #logo {
            float: left;
            /*margin-top: 8px;*/
        }
        #logo img {
            height: 70px;
        }
        #company {
            float: right;
            text-align: right;
            color: #000000;
        }
        #details {
            margin-bottom: 10px;
        }
        #client {
            padding-left: 6px;
            border: 1px solid #CFCFCF;
            float: left;
            padding: 10px;
            width: 100%;
        }
        #client .to {
            color: #777777;
        }
        h2.name {
            font-size: 1.2em;
            font-weight: normal;
            margin-bottom: 0;
            margin-top: 5px;
            color: #000000;
        }
        #invoice {
            float: right;
            text-align: right;
        }
        #invoice h1 {
            color: #0087C3;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0  0 10px 0;
        }
        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }
        table th,
        table td {
            padding: 5px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }
        table th {
            white-space: nowrap;
            font-weight: 900;
            color: #000000;
        }
        table td {
            text-align: center;
            font-size: 12px;
        }
        table td h3{
            color: #57B223;

            font-weight: normal;
            margin: 0 0 0.2em 0;
        }
        table .no {
            color: #FFFFFF;
            font-size: 1.6em;
        }
        table .desc {
            text-align: left;
            background: #DDDDDD;
        }
        table .total {
            background: #57B223;
            color: #FFFFFF;
        }
        table tbody tr:last-child td {
            border: none;
        }
        table tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            white-space: nowrap;
        }
        table tfoot tr:first-child td {
            border-top: none;
        }
        table tfoot tr:last-child td {
            border-bottom: 1px solid #AAAAAA;

        }
        table tfoot tr td:first-child {
            border: none;
        }
        #thanks{
            font-size: 2em;
            margin-bottom: 50px;
        }
        #notices{
            padding-left: 6px;
            border-left: 6px solid #0087C3;
        }
        footer {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;
            text-align: center;
        }
        #title {
            text-align: center;
        }
        .half
        {
            width:47%;
            float:left;
            display:block;
            padding-left:1%;
            padding-right:1%;
            margin-bottom:20px;
        }
        .id1_1{
            margin-bottom:10px;
        }
        {
            border-right:solid 1px #DDDDDD;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-md-6 {
            -webkit-box-flex: 0;
            flex: 0 0 50%;
            max-width: 50%;
        }
        .col-md-12 {
            -webkit-box-flex: 0;
            flex: 0 0 100%;
            max-width: 100%;
        }

        p {
            margin-top: 7px;
            margin-bottom: 7px;
        }

    </style>
</head>

<body>
<header>
    <div style="float: right;margin-top: 30px;">
        <h2 style="text-align: center;">
            Dubai Maintenance Job Card
        </h2>
    </div>
    <div style="margin-left: -25px !important;">
        <img height="100" src="{{ public_path('img/kinglogo.png') }}" />
    </div>
</header>
<main>
    <div class="row">
        <div class="col-md-12">
            <p><span><strong>Date:</strong> {{date('d-m-Y H:i:s')}}</span></p>
        </div>
    </div>
    <div style="clear:both"></div>
    <br />
    <div class="row">
        <div class="col-md-4" style="width: 245px;float: left;">
            <p><span><strong>Task No:</strong> {{$task->track_id}}</span></p>
        </div>
        <div class="col-md-4" style="width: 245px;float: left;">
            <p><span><strong>Task Type:</strong> {{$task->task_type->label}}</span></p>
        </div>
        <div class="col-md-4" style="width: 250px;float: left;">
            <p><span><strong>Doc Ref:</strong> KBF/PRD/18A</span></p>
        </div>
    </div>
    <div style="clear:both"></div>
    <br />
    <div class="row">
        <div class="col-md-4" style="width: 245px;float: left;">
            <p><span><strong>Approved By: </strong> {{$task->task_approved_by->name}}</span></p>
        </div>
        <div class="col-md-4" style="width: 245px;float: left;">
            <p><span><strong>Approved Date:</strong> {{$task->approved_date}}</span></p>
        </div>
    </div>
    <div style="clear:both"></div>
    <br />
    <div class="row">
        <div class="col-md-3" style="width: 210px;float: left;">
            <p><strong>Occurred At</strong></p>
            <span>{{$task->occurred_at}}</span>
        </div>
        <div class="col-md-3" style="width: 210px;float: left;">
            <p><strong>Start Date</strong></p>
            <span>{{$task->start_date}}</span>
        </div>
        <div class="col-md-3" style="width: 210px;float: left;">
            <p><strong>End Date</strong></p>
            <span>{{$task->end_date}}</span>
        </div>
        <div class="col-md-3" style="width: 210px;float: left;">
            <p><strong>Task Time</strong></p>
            <span>{{$task->total_time}}</span>
        </div>
    </div>
    <div style="clear:both"></div>
    <br />
    <br />
    <div class="row">
        <div class="col-md-12">
            <p style="margin-bottom: 12px;"><span><strong>Title:</strong> {{$task->title}}</span></p>
            <p>
                <span>
                    <strong>Description: </strong>
                    {{$task->description}}
                </span>
            </p>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="row">
        <div class="col-md-12">
            <div style="clear:both"></div>
            <p><strong>Spare Used</strong></p>
            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <thead>
                <tr>
                    <th class="qty">Spare Code</th>
                    <th class="unit">Quantity</th>
                    <th class="unit">Part Description</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($task->task_spare_parts as $spare_part)
                    <tr>
                        <th class="qty">{{$spare_part->spare_parts_code}}</th>
                        <th class="unit">{{$spare_part->spare_parts_quantity}}</th>
                        <th class="unit">{{$spare_part->spare_parts_description}}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div style="clear:both"></div>
        <table style="border-top: 1px solid #AAAAAA;">
            <tbody>
            <tr>
                <td style="background-color: transparent;">
                    <h4 style="text-align:center;">Technician</h4>
                    <p style="text-align:center;">{{$task->technician->name}}</p>
                    <p style="text-align:center;">{{ date('d-m-Y H:i:s') }}</p>
                </td>
                <td style="background-color: transparent;">
                    <h4 style="text-align:center;">Approved By</h4>
                    <p style="text-align:center;">{{$task->task_approved_by->name}}</p>
                    <p style="text-align:center;">{{$task->approved_date}}</p>
                </td>
            </tr>
            </tbody>
        </table>
</main>
</body>

</html>