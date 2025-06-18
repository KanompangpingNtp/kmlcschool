@extends('layouts.app')
@section('title', 'Subject-category')
@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <style>
        .bg-home {
            background: url('{{ asset('home/Bg.png') }}') no-repeat center center;
            background-size: cover;
            min-height: 85.2vh;
            padding: 2rem 2rem 2rem 2rem;
        }

        .course-card {
            border-radius: 16px;
            padding: 10px 15px;
            border: 0px solid #0000;
            overflow: hidden;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-5px);
        }

        .course-card img {
            border-radius: 20px;
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .btn-detail {
            background: linear-gradient(to right, #91d5ff, #1186fc);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.5);
            color: white;
            font-size: 20px;
            border-radius: 20px;
            text-decoration: none;
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease;
        }

        .btn-detail:hover {
            background: linear-gradient(to left, #91d5ff, #1186fc);
            box-shadow: 0 6px 16px rgba(17, 134, 252, 0.45);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

    <body>
        <div class="bg-home d-flex align-items-start justify-content-center">
            <div class="container py-1">
                <h1 class="mb-4 text-center">จัดการข้อมูลโปรไฟล์</h1><br>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <!-- รูปภาพตรงกลาง -->
                                <div class="d-flex flex-column align-items-center">
                                    <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('navbar/user-unknow.png') }}"
                                        alt="Profile" class="rounded-circle img-thumbnail mb-3" width="150">
                                </div>

                                <div class="mt-2 text-start">
                                    <h5>ชื่อ: {{ $user->name }}</h5>
                                    <p class="text-muted">อีเมล: {{ $user->email }}</p>
                                    <p class="text-muted">เบอร์ติดต่อ: {{ $user->phone ?? '-' }}</p>
                                </div>

                                <div class="mt-3 text-center">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#userModal{{ $user->id }}">
                                        แก้ไขข้อมูล
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal แก้ไขข้อมูลผู้ใช้ -->
                <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1"
                    aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('UserProfileUpdate', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel{{ $user->id }}">แก้ไขข้อมูลผู้ใช้</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="ปิด"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- ชื่อ -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">ชื่อ</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $user->name }}" required>
                                    </div>
                                    <!-- อีเมล -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">อีเมล</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $user->email }}" required>
                                    </div>
                                    <!-- เบอร์โทร -->
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">เบอร์ติดต่อ</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ $user->phone }}">
                                    </div>
                                    <!-- รูปโปรไฟล์ -->
                                    <div class="mb-3">
                                        <label for="profile_image" class="form-label">รูปโปรไฟล์</label>
                                        <input type="file" class="form-control" name="profile_image" accept="image/*">
                                        @if ($user->profile_image)
                                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Current Profile"
                                                class="img-thumbnail mt-2" width="100">
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">บันทึก</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </body>

@endsection
