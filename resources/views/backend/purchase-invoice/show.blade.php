@extends('layouts.app')
@section('css')
    <style>
        * {
            box-sizing: border-box;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            word-break: break-all;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }

        .h4-14 h4 {
            font-size: 12px;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .img {
            margin-left: "auto";
            margin-top: "auto";
            height: 30px;
        }

        pre,
        p {
            /* width: 99%; */
            /* overflow: auto; */
            /* bpicklist: 1px solid #aaa; */
            padding: 0;
            margin: 0;
        }

        table {
            font-family: arial, sans-serif;
            width: 100%;
            border-collapse: collapse;
            padding: 1px;
        }

        .hm-p p {
            text-align: left;
            padding: 1px;
            padding: 5px 4px;
        }

        td,
        th {
            text-align: left;
            padding: 8px 6px;
        }

        .table-b td,
        .table-b th {
            border: 1px solid #ddd;
        }

        th {
            /* background-color: #ddd; */
        }

        .hm-p td,
        .hm-p th {
            padding: 3px 0px;
        }

        .cropped {
            float: right;
            margin-bottom: 20px;
            height: 100px; /* height of container */
            overflow: hidden;
        }

        .cropped img {
            width: 400px;
            margin: 8px 0px 0px 80px;
        }

        .main-pd-wrapper {
            box-shadow: 0 0 10px #ddd;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .table-bordered th {
            padding: 4px 10px !important;
        }

        .table-bordered td {
            padding: 1px 10px !important;
        }

        .invoice-items {
            font-size: 14px;
            border-top: 1px dashed #ddd;
        }

        .invoice-items td {
            padding: 14px 0;

        }

        @media print {
            @page {
                margin: 15px;
                padding: 10px 20px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container">
        @php
            $setting = \App\Models\Setting::first();
        @endphp
        <div class="row justify-content-center">
            <div class="col-md-7">
                <a href="{{ url()->previous() }}" class="btn btn-dark">Back</a>
                <button onclick="print_invoice()" class="btn btn-primary float-end">Print</button>
                <div id="print_section">
                    <section class="main-pd-wrapper" style="width: 100%; margin: auto">
                        <div style="text-align: center; margin: auto;line-height: 1.5;font-size: 14px;color: #4a4a4a;">

                            <p style="font-weight: bold; color: #000; margin-top: 15px; font-size: 18px;">
                                <img style="width: 30%" src="{{ asset( (isset($setting)) ? $setting->logo : '') }}" alt="">
                            </p>
                            <p style="margin: 15px auto;">{{ isset($setting) ? $setting->address : '' }}</p>
                            <p>Mobile. {{ isset($setting) ? $setting->mobile : '' }} .E-mail : {{ isset($setting) ? $setting->email : '' }}</p>

                            <hr style="border: 1px dashed rgb(131, 131, 131); margin: 25px auto">
                        </div>
                        <p><span><b>Purchase id: </b> {{ $purchaseinvoice->purchase_no }}</span> <span style="float: right"><b>Date : </b> {{ \Carbon\Carbon::parse($purchaseinvoice->date)->format('d/m/Y') }}</span>
                        </p>
                        <table class="table table-bordered invoice_item_table">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">Sn.</th>
                                    <th style="width: 220px;">Name</th>
                                    <th>QTY</th>
                                    <th>Rate</th>
                                    <th style="text-align: right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchaseinvoice->purchaseInvoiceDetails as $item)
                                    <tr class="invoice-items">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->qty }} PC</td>
                                        <td>{{ $item->price }}</td>
                                        <td style="text-align: right">{{ $item->price*$item->qty }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>


                        <table style="width: 100%;margin-top: 15px;border: 1px dashed #dddddd;border-radius: 3px;">
                            <thead>
                                <tr>
                                    <td>
                                        <b>Name : </b>{{ isset($purchaseinvoice->supplierDetails) ? $purchaseinvoice->supplierDetails->name : '' }} <br>
                                        <b>Phone : </b>{{ isset($purchaseinvoice->supplierDetails) ? $purchaseinvoice->supplierDetails->phone_number : '' }} <br>
                                        <b>Email : </b>{{ isset($purchaseinvoice->supplierDetails) ? $purchaseinvoice->supplierDetails->email : '' }} <br>
                                        <b>Address : </b>{{ isset($purchaseinvoice->supplierDetails) ? $purchaseinvoice->supplierDetails->address : '' }} <br>

                                    </td>
                                    <td style="text-align: right;">
                                        <b>Amount : </b> {{ $purchaseinvoice->total }} TK. <br>
                                        <b>Paid : </b> {{ $purchaseinvoice->paid }} TK. <br>
                                        <b>Due : </b> {{ $purchaseinvoice->due }} TK. <br>
                                    </td>
                                </tr>
                            </thead>
                        </table>

                        <table style="width: 100%;margin-top: 15px;border: 1px dashed #dddddd;border-radius: 3px;">
                            <thead>
                                <tr>
                                    <td>
                                        ১. দয়া করে মূল্য পরিশোধ করে পণ্য বুঝে নিন।
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        ২. আমাদের সিল যুক্ত পণ্যের কোনো সমস্যা থাকলে আমরা সমাধান করে দিবো।
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        ৩. ডেলিভারি সম্পর্কিত কোন অভিযোগ বা পরামর্শ থাকলে এই নম্বর এ ({{ isset($setting) ? $setting->mobile : '' }}) যোগাযোগ করুন।
                                    </td>
                                </tr>

                            </thead>
                        </table>

                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function print_invoice() {
            var printContents = document.getElementById('print_section').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
