@extends('staff.layouts.template')

@section('content')
    <div class="mt-16 py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Announcement List</p>
            </div>
            <div>
                <a href="{{ route('staff.addAnnouncement') }}">
                    <div class="btn btn-primary">
                        Add Announcement
                    </div>
                </a>
            </div>
        </div>
        @if ($listAnnouncement != null)
            <div class="mt-8">
                <table class="table table-compact table-striped w-full">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Header</th>
                            {{-- <th class="text-center">Content</th>    --}}
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listAnnouncement as $announcement)
                            <tr class="max-w-xs break-words">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $announcement->header }}</td>
                                {{-- <td class="text-center break-all">{{ $announcement->content }}</td> --}}
                                <td class="text-center">
                                    <a href="{{ route('staff.announcementDetail', $announcement->id) }}"
                                        class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif ($listAnnouncement == null)
            <h1>No Announcement!</h1>
        @endif
    </div>
@endsection
