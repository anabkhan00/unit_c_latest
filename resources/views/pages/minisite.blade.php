@extends('layouts.master')

@section('content')
    @include('pages.main', ['emails' => $emails])
    <link rel="stylesheet" href="{{ asset('css/minisite.css') }}">
    <style>
        .btn.dropdown-toggle::after {
            border-top-color: black !important;
        }
    </style>
    <div class="container" id="minisite-content" style="position: absolute; top: 175px; left: 60px; width: 95%;">
        <div class="row">


            <div class="col-lg-7 col-md-7 p-3 rounded welcome" >
                <div class="row">
                    <div class="col-md-12"
                        style="color: #0C5097;font-family: Montserrat, sans-serif;
                                font-size: 28px;
                                font-weight: 700;
                                line-height: 48.76px;
                                text-align: left;
                                ">
                        WELCOME TO MINISITE 
                    </div>

                    <div class="col-md-5">
                        <button class="btn btn-lg dropdown-toggle" type="button"
                            style="padding:5px;background: #D9D9D9 ;color:black;font-weight:600; width:100%"
                            data-bs-toggle="dropdown" id="teamDropdown">
                            <span style="font-size: 24px;" id="selectedTeam">Select Team</span>
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($teams as $team)
                                <li>
                                    <a class="dropdown-item team-option" href="#" data-team-id="{{ $team->id }}"
                                        data-team-name="{{ $team->team_name }}">
                                        {{ $team->team_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div id="minisiteRecords"
                            style="display: none; margin-top: 5px; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                            <ul class="m-0" id="recordList" style="list-style-type: none; padding-left: 0;"></ul>
                        </div>
                    </div>
                </div>


                <div>

                </div>



                <div style="display: flex; margin-top: 15px; margin-bottom: 15px;">
                    <button class="btn" type="button"
                        style="background: #0C5097; margin-right: 15px; color: white; font-size: 12px;"
                        data-bs-toggle="modal" data-bs-target="#addPageModal">Add New Page</button>
                    <button class="btn" type="button" style="background-color: #0C5097; color: white; font-size: 12px;"
                        data-bs-toggle="modal" data-bs-target="#addDocumentModal">Add Document</button>
                </div>
            
                <div>
                    <div style="margin-bottom: 10px;">
                        <span style="font-size: 16px ; font-weight: 500;">
                            Minisite makes it easy for you to collaborate and arrange relavant content for your
                            specific teams.
                        </span>
                    </div>
                    <div>
                        <span style="font-size: 16px ; font-weight: 500;">
                            Please visit your relavent minisite by clicking the dropdown on the left side bar or add
                            a new page to the existing Minisite.
                        </span>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div style="display: flex;">
                     
                    <div>
                        <img src="http://172.25.240.1:8000/images/avatar.png"
                            style="width: 70px; height: 70px; object-fit: cover; border-radius: 100px;" alt="">
                    </div>
                    <div style="padding-top: 10px; padding-left: 5px;">
                        <p style="font-size: 14px;font-weight: bold;margin-bottom: 3px;">Yaqoob Abubakar
                            <span
                                style="background: #0C5097; color: white; font-size: 8px; padding: 1px 4px 2px 4px; border-radius: 10px;">
                                Admin
                            </span>
                        </p>
                        <p style="font-size: 14px;color: #707070;">Project Manager, Tresmark</p>
                    </div>
                </div>
                    </div>
                           <div class="col-md-6">
                        <div style="display: flex;">
                   <div>
                        <img src="http://172.25.240.1:8000/images/avatar.png"
                            style="width: 70px; height: 70px; object-fit: cover; border-radius: 100px;" alt="">
                    </div>
                    <div style="padding-top: 10px; padding-left: 5px;">
                        <p style="font-size: 14px;font-weight: bold;margin-bottom: 3px;">Yaqoob Abubakar
                            <span
                                style="background: #0C5097; color: white; font-size: 8px; padding: 1px 4px 2px 4px; border-radius: 10px;">
                                Admin
                            </span>
                        </p>
                        <p style="font-size: 14px;color: #707070;">Project Manager, Tresmark</p>
                    </div>
                </div>
                    </div>
                           <div class="col-md-6 mt-3">
                        <div style="display: flex;">
                   <div>
                        <img src="http://172.25.240.1:8000/images/avatar.png"
                            style="width: 70px; height: 70px; object-fit: cover; border-radius: 100px;" alt="">
                    </div>
                    <div style="padding-top: 10px; padding-left: 5px;">
                        <p style="font-size: 14px;font-weight: bold;margin-bottom: 3px;">Yaqoob Abubakar
                            <span
                                style="background: #0C5097; color: white; font-size: 8px; padding: 1px 4px 2px 4px; border-radius: 10px;">
                                Admin
                            </span>
                        </p>
                        <p style="font-size: 14px;color: #707070;">Project Manager, Tresmark</p>
                    </div>
                </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6 col-md-6" id="pageDetails" style="display: none;">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 id="pageTitle" class="card-title mb-0"></h3>
                    </div>
                    <div class="card-body" id="pageRecords">
                        <!-- Content will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-5">
                <div>
                    <img src="{{ asset('images/minisite.png') }}"
                        style="width: 400px; position: absolute;
                                object-fit:cover;
                                height: 250px;
                                left: 770px;
                                gap: 0px;
                                opacity: 0px;
                                z-index: -1;
                                "
                        alt="">
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4" id="teamActivityContainer"
            style="position: fixed; bottom: 0; right: 10px; transition: bottom 0.4s ease;">
            <div style="width: 100%; margin-left: auto;">
                <div style="background: #0C5097; border-radius: 7px 7px 0px 0px; cursor: pointer;" id="activity">
                    <p
                        style="color: white; text-align: center; margin-bottom: 10px; padding: 10px; font-size: large; font-weight: bold;">
                        Team Activity
                    </p>
                </div>

                <div id="activityContent"
                    style="height: 0; background-color: white; padding-left: 15px; padding-right: 5px; transition: height 0.4s ease;">
                    <div style="padding-top: 15px; padding-bottom: 1px; background-color: white" >
                        <p style="margin-bottom: 0px; font-size: 12px; color: black;">Today - 11:30am</p>
                        <p style="font-size: 13px; font-weight: bold;">Abdul Moiz <span style="color: #A2A2A2;">added a
                                document</span></p>
                    </div>
                    <div style="background-color: white;">
                        <p style="margin-bottom: 0px; font-size: 12px;">Yesterday - 01:30pm</p>
                        <p style="font-size: 13px; font-weight: bold">Team had a video call</p>
                    </div>
                    <div style="background-color: white;">
                        <p style="margin-bottom: 0px; font-size: 12px;">2nd August, 2021 - 01:30pm</p>
                        <p style="font-size: 13px; font-weight: bold">Yaqoob Abubakar<span style="color: #A2A2A2;"> Changed
                                team name to</span><span style="color: #036AB2;"> Risk Management</span></p>
                    </div>
                    <div style="background-color: white;">
                        <p style="margin-bottom: 0px; font-size: 12px;">1st August, 2021 - 04:57pm</p>
                        <p style="font-size: 13px; font-weight: bold">Yaqoob Abubakar <span style="color: #A2A2A2;">added
                                Aalya Asani</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding page -->
    <div class="modal fade" id="addPageModal" tabindex="-1" aria-labelledby="addPageLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPageLabel">Add New Page</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('minisites.storePage') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Page Logo</label>
                            <input type="file" name="page_logo" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Page Title</label>
                            <input type="text" name="page_title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Page Description</label>
                            <textarea name="page_description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Team</label>
                            <select name="team_id" class="form-select" required>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->team_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color: #0C5097;">Add
                            Page</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Adding New Document -->
    <div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="addDocumentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDocumentLabel">Add Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('minisites.storeDocument') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Document</label>
                            <input type="file" name="document" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Document Title</label>
                            <input type="text" name="document_title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Team</label>
                            <select name="team_id" class="form-select" required>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->team_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color: #0C5097;">Add
                            Document</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Page Modal -->
    <div class="modal fade" id="editPageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Page</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editPageId">

                    <div class="mb-3">
                        <label for="editPageTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editPageTitle">
                    </div>

                    <div class="mb-3">
                        <label for="editPageDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editPageDescription"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="currentPageImage" class="form-label">Current Image</label>
                        <div id="currentPageImageContainer">
                            <img id="currentPageImage" src="" alt="Page Image" class="img-fluid"
                                style="max-height: 200px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="editPageImage" class="form-label">Upload New Image</label>
                        <input type="file" class="form-control" id="editPageImage">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updatePage()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".team-option").forEach(item => {
        item.addEventListener("click", function (e) {
            e.preventDefault();

            let teamId = this.getAttribute("data-team-id");
            let teamName = this.getAttribute("data-team-name");

            document.getElementById("selectedTeam").innerText = teamName;
            //document.getElementById("displayTeam").innerText = teamName;

            fetch(`/get-minisite-records/${teamId}`)
                .then(response => response.json())
                .then(data => {
                    let recordList = document.getElementById("recordList");
                    recordList.innerHTML = "";

                    if (data.length > 0) {
                        data.forEach(record => {
                            //console.log(record);
                            let listItem = document.createElement("li");
                            listItem.innerHTML = `<strong>${capitalizeWords(record.page_title)}</strong>`;
                            listItem.style.padding = "5px 0";
                            listItem.style.cursor = "pointer";
                            listItem.style.transition = "background 0.3s ease";
                            listItem.setAttribute("data-page-id", record.id);
                            listItem.onmouseover = function () {
                                listItem.style.backgroundColor = "#0C5097";
                                listItem.style.borderRadius = "5px";
                                listItem.style.color = "white";
                                listItem.style.padding = "5px 5px";
                            };
                            listItem.onmouseout = function () {
                                listItem.style.backgroundColor = "transparent";
                                listItem.style.color = "black";
                                listItem.style.padding = "5px 0px";
                            };
                            recordList.appendChild(listItem);
                        });
                    } else {
                        recordList.innerHTML = '<li style="color: gray;">No records found</li>';
                    }
                })
                .catch(error => {
                    console.error("Error fetching minisite records:", error);
                    document.getElementById("recordList").innerHTML = '<li style="color: red;">Failed to load records</li>';
                });
        });
    });

    function capitalizeWords(str) {
        return str.replace(/\b\w/g, char => char.toUpperCase());
    }

    document.getElementById("recordList").addEventListener("click", function (e) {
        let listItem = e.target.closest("li"); // Ensure we get the LI even if clicking on <strong>

        if (listItem && listItem.hasAttribute("data-page-id")) {
            let pageId = listItem.getAttribute("data-page-id");
            //console.log(pageId);
            document.querySelector(".welcome").style.display = "none";

            fetch(`/get-page-records/${pageId}`)
                .then(response => response.json())
                .then(data => {
                    let page = data[0];

                    let pageDetails = document.getElementById("pageDetails");
                    pageDetails.style.display = "block";
                    document.getElementById("pageTitle").innerText = capitalizeWords(page.page_title);
                    document.getElementById("pageRecords").innerHTML = `
                        <div>
                            <img src="/${page.image}" alt="${page.page_title}" class="page-image" style="width:10%">
                        </div>
                        <div class="page-description">
                            <p>${page.page_description}</p>
                        </div>
                        <div class="page-actions mt-3">
                            <button class="btn btn-edit" onclick="editPage(${page.id})">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-delete" onclick="confirmDelete(${page.id})">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </div>
                    `;

                })
                .catch(error => {
                    console.error("Error fetching page details:", error);
                });
        }
    });

});

function editPage(pageId) {
    fetch(`/get-page-record/${pageId}`)
        .then(response => response.json())
        .then(page => {
            //console.log(page);
            let editPageId = document.getElementById("editPageId");
            let editPageTitle = document.getElementById("editPageTitle");
            let editPageDescription = document.getElementById("editPageDescription");
            let currentPageImage = document.getElementById("currentPageImage");

            if (!editPageId || !editPageTitle || !editPageDescription || !currentPageImage) {
                console.error("Edit page modal elements not found.");
                Swal.fire("Error", "Edit modal not properly loaded!", "error");
                return;
            }

            editPageId.value = page.id;
            editPageTitle.value = page.page_title;
            editPageDescription.value = page.page_description;

            // Display current image
            currentPageImage.src = page.page_logo ? `${page.page_logo}` : "";

            let editModal = new bootstrap.Modal(document.getElementById("editPageModal"));
            editModal.show();
        })
        .catch(error => {
            Swal.fire("Error", "Failed to fetch page details", "error");
            console.error("Error fetching page details for edit:", error);
        });
}


function updatePage() {
    let pageId = document.getElementById("editPageId").value;
    let title = document.getElementById("editPageTitle").value;
    let description = document.getElementById("editPageDescription").value;
    let pageImage = document.getElementById("editPageImage").files[0];

    let formData = new FormData();
    formData.append("page_title", title);
    formData.append("page_description", description);
    if (pageImage) {
        formData.append("page_logo", pageImage);
    }

    fetch(`/update-page/${pageId}`, {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": csrfToken
        },
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: "Success!",
                    text: "Page updated successfully.",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire("Error", "Failed to update page.", "error");
            }
        })
        .catch(error => console.error("Error updating page:", error));
}

function confirmDelete(pageId) {
    Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/delete-page/${pageId}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": csrfToken
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "The page has been deleted.",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error", "Failed to delete page.", "error");
                    }
                })
                .catch(error => {
                    Swal.fire("Error", "Something went wrong!", "error");
                    console.error("Error deleting page:", error);
                });
        }
    });
}

document.getElementById('activity').addEventListener('click', function () {
    let content = document.getElementById('activityContent');
    let container = document.getElementById('teamActivityContainer');

    if (content.style.height === '0px' || content.style.height === '') {
        content.style.height = '200px'; // Smoothly expand
        container.style.bottom = '200px'; // Move up smoothly
    } else {
        content.style.height = '0px';
        container.style.bottom = '0';
    }
});


    </script>
    <script>
        $(document).ready(function() {
            $('.team-option').on('click', function(e) {
                e.preventDefault();

                const teamName = $(this).data('team-name');
                $('#selectedTeam').text(teamName);

                // Show the minisiteRecords div
                $('#minisiteRecords').show();
            });
        });
    </script>
@endpush
