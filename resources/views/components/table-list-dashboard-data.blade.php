@props(['bcsData'])

<div class="flex flex-col h-full">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse min-h-[300px]">
            <thead>
                <tr class="text-basicfont text-sm font-semibold">
                    <th class="border-b p-4 text-center">No</th>
                    <th class="border-b p-2 text-left">Tag ID Sapi</th>
                    <th class="border-b p-2 text-left">BCS Score</th>
                    <th class="border-b p-2 text-left">Perhatian Khusus</th>
                    <th class="border-b p-2 text-left">Tanggal Pengecekan</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($bcsData as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-sm text-center">
                            {{ ($bcsData->currentPage() - 1) * $bcsData->perPage() + $loop->iteration }}
                        </td>
                        <td class="p-4 text-sm font-medium">
                            {{ $item->cow->tag_id ?? '-' }}
                        </td>
                        <td class="p-4 text-sm">
                            BCS {{ $item->bcs_score }}
                        </td>
                        <td class="p-4 text-sm">
                            <select class="border rounded px-2 py-1 text-sm attention-select"
                                data-id="{{ $item->id }}">
                                <option value="0" {{ $item->attention == 0 ? 'selected' : '' }}>
                                    Tidak Butuh
                                </option>
                                <option value="1" {{ $item->attention == 1 ? 'selected' : '' }}>
                                    Butuh Perhatian Khusus
                                </option>
                                <option value="2" {{ $item->attention == 2 ? 'selected' : '' }}>
                                    Sangat Butuh Perhatian Khusus
                                </option>
                            </select>
                        </td>
                        <td class="p-4 text-sm">
                            {{ $item->assessment_date }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-8 text-gray-400">
                            No Data Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-3 flex justify-end">
        {{ $bcsData->links() }}
    </div>
</div>

<script>
document.querySelectorAll('.attention-select').forEach(select => {
    select.addEventListener('change', function () {
        const attention = this.value;
        const id = this.dataset.id;

        fetch(`/bcs/${id}/attention`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ attention })
        })
        .then(res => res.json())
        .then(data => {
            console.log('Saved', data);
        })
        .catch(err => console.error(err));
    });
});
</script>