@extends('admin.layouts.template')

@section('content')
    <div class="py-8 px-4">
        <div class="flex justify-between">
            <div>
                <p class="text-semibold text-3xl">Announcement List</p>
            </div>
            <div>
                <a href="{{ route('admin.addAnnouncement') }}">
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
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listAnnouncement as $announcement)
                            <tr class="max-w-xs break-words">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $announcement->header }}</td>
                                <td class="text-center">
                                    @if ($announcement->status > '0')
                                        <a href="{{ route('staff.announcementDetail', $announcement->id) }}"
                                            class="btn btn-disabled">Approved
                                        </a>
                                    @elseif ($announcement->status == '0')
                                        <a href="{{ route('admin.approveAnnouncement', $announcement->id) }}"
                                            class="btn btn-error">Approve
                                        </a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($announcement->trashed())
                                        <div class="btn btn-disabled">Detail
                                        </div>
                                        <a href="{{ route('admin.restoreAnnouncement', $announcement->id) }}"
                                            class="btn btn-error">Restore
                                        </a>
                                    @else
                                        <a href="{{ route('admin.announcementDetail', $announcement->id) }}"
                                            class="btn btn-primary">Detail
                                        </a>
                                        <a href="{{ route('admin.deleteAnnouncement', $announcement->id) }}"
                                            class="btn btn-error">Delete
                                        </a>
                                    @endif
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
