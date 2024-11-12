<table>
  <thead>
      <tr>
          <th style="font-weight: bold; font-size: 16px; text-align: center; background-color:#000000; color:#F1C761;" colspan="15">Guinness ID - Redeem Data</th>
      </tr>
      @if ($start_date != '' && $end_date != '')
      <tr>
          <th style="font-size: 12px; text-align: center; background-color:#211804; color:#ffffff;" colspan="15">Range: {{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</th>
      </tr>
      @else
      <tr>
          <th style="font-size: 12px; text-align: center; background-color:#211804; color:#ffffff;" colspan="15">Range: All</th>
      </tr>
      @endif
      <tr>
          <th style="font-size: 12px; text-align: center; background-color:#362807; color:#ffffff;" colspan="15">Export Date: {{ \Carbon\Carbon::now()->format('d F Y H:i:s') }}</th>
      </tr>
      <tr>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">No</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Order ID</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">First Name</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Last Name</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Email</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Merchandise</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Total</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Status</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Phone Number</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Address</th>
          {{-- <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Province</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">City</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">District</th> --}}
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Deliver Date</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Resi</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Courier</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Receive Date</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Redeem Date</th>
      </tr>
  </thead>
  <tbody>
      @if (count($data))
      @foreach ($data as $key => $item)
      <tr>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $loop->iteration }}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->order_code ?? '-'}}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->user->first_name ?? '-'}}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->user->last_name ?? '-'}}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->user->email ?? '-' }}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->merchandise->title ?? '-' }}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ number_format($item->grand_total) ?? '-' }}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->status }}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->user->phone ?? '-' }}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->user->address ?? '-' }}</td>
          {{-- <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->address->province->name ?? '-' }}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->address->city->name ?? '-' }}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->address->district->name ?? '-' }}</td> --}}
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->delivered_at ? $item->delivered_at->format('d/m/Y H:i:s') : '-' }}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->resi ?? '-' }}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->courier ?? '-' }}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->received_at ? $item->received_at->format('d/m/Y H:i:s') : '-' }}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->created_at->format('d/m/Y H:i:s') ?? '-' }}</td>
      </tr>
      @endforeach
      @endif
  </tbody>
</table>
