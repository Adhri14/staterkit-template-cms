<table>
  <thead>
      <tr>
          <th style="font-weight: bold; font-size: 16px; text-align: center; background-color:#000000; color:#F1C761;" colspan="8">Transaction Data - Kasir Simple</th>
      </tr>
      @if (!is_null($start_date) && !is_null($end_date))
      <tr>
          <th style="font-size: 12px; text-align: center; background-color:#211804; color:#ffffff;" colspan="8">Range: {{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</th>
      </tr>
      @else
      <tr>
          <th style="font-size: 12px; text-align: center; background-color:#211804; color:#ffffff;" colspan="8">Range: All</th>
      </tr>
      @endif
      <tr>
          <th style="font-size: 12px; text-align: center; background-color:#362807; color:#ffffff;" colspan="8">Export Date: {{ \Carbon\Carbon::now()->format('d F Y H:i:s') }}</th>
      </tr>
      <tr>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">No</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Oder Code</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Type Transaction</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Transaction Detail</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Grand Total</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Pay</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Return</th>
          <th style="border: 3px solid #000000; font-weight: bold; text-align: center; background-color:#F1C761; color: #000000;">Created Date</th>
      </tr>
  </thead>
  <tbody>
      @if (count($data))
      @foreach ($data as $key => $item)
      <tr>
          <td style="border: 1px solid #000000; vertical-align: middle; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $loop->iteration }}</td>
          <td style="border: 1px solid #000000; vertical-align: middle; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->order_code ?? '-'}}</td>
          <td style="border: 1px solid #000000; text-transform: uppercase; vertical-align: middle; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->type_transaction ?? '-'}}</td>
          <td style="border: 1px solid #000000; vertical-align: middle; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">
                <ul>
                    @foreach (json_decode($item->transaction_detail) as $element)
                        <li>
                            {{-- <span>{{ $element->title ?? '' }} &nbsp;&nbsp; x{{ $element->qty }} &nbsp;&nbsp; Rp. {{ number_format((int) $element->price * (int)$element->qty) }}</span> --}}
                            <span>Product Name : {{ $element->title ?? '' }}</span><br>
                            <span>Quantity : {{ $element->qty ?? '' }}</span><br>
                            <span>Price : Rp. {{ number_format($element->price) ?? '' }}</span><br>
                            <span>Discount : {{ isset($element->discount) ? 'Rp. ' . number_format($element->discount) : '-' }}</span><br>
                            <span>Subtotal : Rp. {{ number_format((int) isset($element->discount) ? $element->discount * (int) $element->qty : $element->price * (int)$element->qty) }}</span><br>
                        </li>
                    @endforeach
                </ul>
        </td>
          <td style="border: 1px solid #000000; vertical-align: middle; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">Rp. {{ number_format($item->grand_total) ?? '-' }}</td>
          <td style="border: 1px solid #000000; vertical-align: middle; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">Rp. {{ number_format($item->cash) ?? '-' }}</td>
          <td style="border: 1px solid #000000; vertical-align: middle; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">Rp. {{ number_format($item->refund) ?? '-' }}</td>
          <td style="border: 1px solid #000000; vertical-align: middle; text-align: center; {{ $key % 2 == 0 ? 'background-color: #ffffff' : 'background-color: #dee2e6' }}">{{ $item->created_at->format('d/m/Y H:i:s') ?? '' }}</td>
      </tr>
      @endforeach
      @endif
  </tbody>
</table>
