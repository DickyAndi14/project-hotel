<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Invoice Transaksi</title>

		<!-- Favicon -->
		<link rel="icon" href="./images/favicon.png" type="image/x-icon" />

		<!-- Invoice styling -->
		<style>

            #customers {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            }

            #customers tr:nth-child(even){background-color: #f2f2f2;}

            #customers tr:hover {background-color: #ddd;}

            #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #626464;
            color: white;
            }
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				color: #777;
			}

			body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
			}

			body h3 {
				font-weight: 300;
				margin-top: 10px;
				margin-bottom: 20px;
				font-style: italic;
				color: #555;
			}

			body a {
				color: #06f;
			}

			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				border-collapse: collapse;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table>
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
                                    <h4  style="font-weight: bold">HOTEL HEBAT</h4>
								</td>

								<td>
									Invoice #: {{ $model->kode_booking }}<br />
									Tanggal: {{ \Carbon\Carbon::parse($model->created_at)->toFormattedDateString() }}<br />
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									{{ $model->user->name }},<br />
									{{ $model->user->email }}
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
            <table id="customers">
                <tr>
                    <th>Nama Kamar</th>
                    <th>Tipe Kamar</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Jumlah</th>
                    <th>Nama Tamu</th>
                    <th>No Hp</th>
                    <th>Status</th>
                </tr>
                @foreach ($model->transaksiDetail as $item)
                    <tr>
                        <td>{{ $item->kamar->name }}</td>
                        <td>{{ $item->kamar->tipeKamar->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->checkin)->toFormattedDateString() }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->checkout)->toFormattedDateString() }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->tamu }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>
                            @switch($item->status)
                                @case(0)
                                    Check Out
                                    @break
                                @default
                                    Active
                            @endswitch
                        </td>
                    </tr>
                @endforeach
            </table>
		</div>
	</body>
</html>