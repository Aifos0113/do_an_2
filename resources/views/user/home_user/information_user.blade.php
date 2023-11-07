@extends('user.layout_user.app')

@section('content')
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
{{--        <nav class="nav nav-borders">--}}
{{--            <a class="nav-link active ms-0" href="https://www.bootdey.com/snippets/view/bs5-edit-profile-account-details" target="__blank">Profile</a>--}}
{{--            <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-billing-page" target="__blank">Billing</a>--}}
{{--            <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-profile-security-page" target="__blank">Security</a>--}}
{{--            <a class="nav-link" href="https://www.bootdey.com/snippets/view/bs5-edit-notifications-page"  target="__blank">Notifications</a>--}}
{{--        </nav>--}}
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Ảnh đại diện</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG hoặc PNG không quá 5 MB</div>
                        <!-- Profile picture upload button-->
                        <button type="button" class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#exampleModal">Cập nhật</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Chi tiết tài khoản</div>
                    <div class="card-body">
                        <form>
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Họ và tên</label>
                                <input class="form-control" id="inputUsername" type="text" placeholder="{{$user->name}}"  disabled>
                            </div>
                            <!-- Form Row        -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputOrgName">Số điện thoại</label>
                                    <input class="form-control" id="inputOrgName" type="text" placeholder="{{$user->sdt}}" disabled>
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLocation">Căn cước công dân</label>
                                    <input class="form-control" id="inputLocation" type="text" placeholder="{{$user->cccd}}" disabled>
                                </div>
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Địa chỉ email</label>
                                <input class="form-control" id="inputEmailAddress" type="email" placeholder="{{$user->email}}" disabled>
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Quê quán</label>
                                    <input class="form-control" id="inputPhone" type="tel" placeholder="{{$user->dia_chi}}" disabled>
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Ngày sinh</label>
                                    <input class="form-control" id="inputBirthday" type="text" name="birthday" placeholder="{{$user->ngay_sinh }}" disabled>
                                </div>
                            </div>
                            <!-- Save changes button-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật thông tin</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="regForm" action="">
                        <!-- One "tab" for each step in the form: -->
                        <div class="tab">
                            <h3 class="display-6">Nhập:</h3>
                            <p><input class="form-control shadow p-3 mb-5 bg-body rounded" name="name" placeholder="Họ và tên" oninput="this.className = ''"></p>
                            <p><input class="form-control shadow p-3 mb-5 bg-body rounded" name="dia_chi" placeholder="Địa chỉ" oninput="this.className = ''"></p>
                        </div>

                        <div class="tab">
                            <h3 class="display-6">Liên hệ:</h3>
                            <p><input class="form-control shadow p-3 mb-5 bg-body rounded" name="cccd" type="number" placeholder="Căn cước công dân..." oninput="this.className = ''"></p>
                            <p><input class="form-control shadow p-3 mb-5 bg-body rounded" name="sdt" type="number" placeholder="Số điện thoại..." oninput="this.className = ''"></p>
                        </div>

                        <div class="tab">
                            <h3 class="display-6">Birthday:</h3>
                            <p><input class="form-control shadow p-3 mb-5 bg-body rounded" name="date" placeholder="dd/mm/yyyy" type="date" oninput="this.className = ''"></p>
                        </div>

                        <div class="tab">
                            <p class="display-6">Login Info:</p>
                            <p><input class="form-control shadow p-3 mb-5 bg-body rounded" name="email" placeholder="E-mail..." oninput="this.className = ''"></p>
                            <p><input class="form-control shadow p-3 mb-5 bg-body rounded" name="password" placeholder="Mật khẩu..." oninput="this.className = ''"></p>
                        </div>

                        <div style="overflow:auto;">
                            <div style="float:right;">
                                <button type="button" class="btn btn-outline-primary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                <button type="button" class="btn btn-outline-primary" id="nextBtn" onclick="nextPrev(1)">Next</button>
                            </div>
                        </div>

                        <!-- Circles which indicate the steps of the form: -->
                        <div style="text-align:center;margin-top:40px;">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form ...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            // ... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            // ... and run a function that displays the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form... :
            if (currentTab >= x.length) {
                //...the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false:
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class to the current step:
            x[n].className += " active";
        }
    </script>

@endsection
