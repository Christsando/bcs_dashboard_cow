<table class="w-full border-collapse">
    <thead>
        <tr class="text-basicfont text-sm font-semibold">
            <th class="border-b text-center">No</th>
            <th class="border-b p-2 text-left">Tag ID Sapi</th>
            <th class="border-b text-left">Jenis Kelamin</th>
            <th class="border-b p-4 text-left">Deskripsi BCS Sapi</th>
            <th class="border-b p-4 text-left">Perhatian Khusus</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @if (isset($bcsData) && $bcsData->count() > 0)
            @foreach ($bcsData as $index => $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 text-sm">{{ ($bcsData->currentPage() - 1) * 10 + $loop->iteration }}</td>
                    <td class="p-4 text-sm text-blue-600 font-medium">{{ $item->tag_id }}</td>
                    <td class="p-4 text-sm">{{ $item->jenis_kelamin }}</td>
                    <td class="p-4 text-sm">{{ $item->deskripsi_bcs }}</td>
                    <td class="p-4 text-sm">
                        @if ($item->perhatian_khusus == 'Butuh Perhatian Khusus')
                            <span class="inline-flex items-center gap-2">
                                <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                                <span class="text-red-500">{{ $item->perhatian_khusus }}</span>
                            </span>
                        @elseif($item->perhatian_khusus == 'Tidak Butuh')
                            <span class="inline-flex items-center gap-2">
                                <i class="fa-solid fa-circle-check text-green-500"></i>
                                <span class="text-green-500">{{ $item->perhatian_khusus }}</span>
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2">
                                <i class="fa-solid fa-circle text-yellow-400"></i>
                                <span class="text-yellow-500">{{ $item->perhatian_khusus }}</span>
                            </span>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5" class="p-8 pt-52">
                    <div class="flex flex-col items-center justify-center">
                        <i class="fa-solid fa-inbox text-4xl mb-3 text-gray-300"></i>
                        <p class="text-lg font-medium text-gray-500">No Data Found</p>
                        <p class="text-sm text-gray-400">Tidak ada data yang tersedia</p>
                    </div>
                </td>
            </tr>
        @endif
    </tbody>
</table>
