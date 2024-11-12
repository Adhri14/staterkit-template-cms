<table>
  <thead>
      <tr>
          <th style="font-weight: bold; font-size: 16px; text-align: center; background-color:#000000; color:#F1C761;" colspan="6">Voucher histories Data - Guinness ID</th>
      </tr>
      @if (!is_null($start_date) && !is_null($end_date))
      <tr>
          <th style="font-size: 12px; text-align: center; background-color:#211804; color:#ffffff;" colspan="6">Range: {{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</th>
      </tr>
      @else
      <tr>
          <th style="font-size: 12px; text-align: center; background-color:#211804; color:#ffffff;" colspan="6">Range: All</th>
      </tr>
      @endif
      <tr>
          <th style="font-size: 12px; text-align: center; background-color:#362807; color:#ffffff;" colspan="6">Export Date: {{ \Carbon\Carbon::now()->format('d F Y H:i:s') }}</th>
      </tr>
      <tr>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">No</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">First Name</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Last Name</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Email</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Voucher Code</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Register Date</th>
      </tr>
  </thead>
  <tbody>
      @if (count($data))
      @foreach ($data as $key => $item)
      <tr>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $loop->iteration }}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->user->first_name ?? '-'}}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->user->last_name ?? '-'}}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->user->email ?? '-' }}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->voucher->code ?? '-'}}</td>
          <td style="border: 1px solid #000000; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->created_at->format('d/m/Y H:i:s') ?? '' }}</td>
      </tr>
      @endforeach
      @endif
  </tbody>
</table>
