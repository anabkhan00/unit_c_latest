
@extends('layouts.master')

@section('content')
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @include('pages.main', ['emails' => $emails])
    <link rel="stylesheet" href="{{ asset('css/minisite.css') }}">
    <style>
        .btn.dropdown-toggle::after {
            border-top-color: black !important;
        }
    </style>
    <div class="container" id="minisite-content" style="position: absolute; top: 175px; left: 60px; width: 95%;">
        <div class="row">
<div class="row">

  <div class="container mt-4">
    <div class="row align-items-start">
      <!-- Left Column -->
      <div class="col-md-3 p-2 m-0 rounded" style="background-color: #edf0f2 ; height: 500px; ">
        <!-- Dropdown -->
        <div class="dropdown p-0 m-0 mb-3">    
          <button class="btn btn-secondary dropdown-toggle w-100 rounded-0" type="button id="dropdownMenuButton"
            data-bs-toggle="dropdown"
            aria-expanded="false""
                            style="padding:5px;background: #000000 ;color:rgb(255, 255, 255);font-weight:600; width:100%"
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

        <!-- Buttons under dropdown -->
        <div class="row">
          <div class="col-6">
            {{--  <button class="btn btn-primary w-100 rounded-0">Button 1</button>  --}}
            <button class="btn w-100 rounded" type="button"
                        style="background: #0C5097;  color: white; font-size: 12px;"
                        data-bs-toggle="modal" data-bs-target="#addPageModal"><p class="m-0"><i class="bi bi-file-earmark-plus" style="color:white !important ; font-size: 18px"></i></p>
                    <p class="m-0">Add New Page</p></button>
          </div>
          <div class="col-6">
            <button id="showDocumentsBtn"
                style="background: #0C5097;  color: white; font-size: 12px;" class="btn btn-outline-primary w-100 rounded">
 <p class="m-0"><i class="bi bi-folder" style="color:white !important ; font-size: 18px"></i></p>
                    <p class="m-0">Documents</p>
</button>

          </div>
        </div>

        <div class="row mt-2">
          <div class="col-12">
            <div class="col-md-12 mt-2">
                        <div id="minisiteRecords"
                            style="display: none; margin-top: 5px; padding: 10px;  border-radius: 0px;">
                            <ul class="m-0" id="recordList" style="list-style-type: none;  padding-left: 0;"></ul>
                        </div>
                    </div>
           
          </div>
        </div>
      </div>

      <!-- Right Column Sections -->
      <div class="col-md-9">
        {{--  sirf document dutton ka click par ya active ho paki par ya show na ho  --}}
        <div id="document-main" class="content-section  border p-3" style="color: #0C5097;">
            <button class="btn mb-3" type="button" style="background-color: #0C5097; color: white; font-size: 12px;"
                        data-bs-toggle="modal" data-bs-target="#addDocumentModal">Add Document</button>
                        <div class="row">
                            @foreach ($documents as $document)
                            <div class=" col-4 document-item mb-2 p-3 ">
                          <div class="row">
                            <div class="col-md-12 border p-5 rounded ">
                                <p class="text-center">      {{ $document->document_title }}</p>
                            </div>
                          </div>
                            </div>
                        @endforeach
                        </div>

        </div>
        <div id="team-main" class="content-section  text-white  p-3">
            <div class="col-lg-12 col-md-12" id="pageDetails" style="display: none;">
             
               
                    <div class="card-body w-100" id="pageRecords">
                        <!-- Content will be populated by JavaScript -->
                    </div>
             
            </div>
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


                <div>

                </div>



                <div style="display: flex; margin-top: 15px; margin-bottom: 15px;">
                    
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


        <!-- Documents -->
        <div id="documents" class="content-section bg-secondary text-white border p-3 d-none">
          <h4>Documents</h4>
          <p>Documents content appears here.</p>
        </div>

       </div>
      </div>
    </div>
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
    <script src="{{ asset('js/minisite.js') }}"></script>
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
                            listItem.innerHTML = `${capitalizeWords(record.page_title)}`;
                            listItem.style.padding = "10px 0px";
                              listItem.style.color = "#0C5097";
                            listItem.style.cursor = "pointer";
                               listItem.style.fontSize = "14px";   // ✅ font size set
    listItem.style.fontWeight = "500";  // ✅ font weight set
            listItem.style.borderBottom = "1px solid #0C5097"; // ✅ added border
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
  listItem.style.color = "#0C5097";
              listItem.style.borderBottom = "1px solid #0C5097"; // ✅ added border
    listItem.style.padding = "10px 0px";
    listItem.style.fontSize = "14px";   // ✅ font size set
    listItem.style.fontWeight = "500";  // ✅ font weight set
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
    let listItem = e.target.closest("li");

 if (listItem && listItem.hasAttribute("data-page-id")) {
    let pageId = listItem.getAttribute("data-page-id");
    document.querySelector(".welcome").style.display = "none";

    fetch(`/get-page-records/${pageId}`)
        .then(response => response.json())
        .then(data => {
            let page = data[0];
            let pageDetails = document.getElementById("pageDetails");
            pageDetails.style.display = "block";


            document.getElementById("pageRecords").innerHTML = `
                <div style="font-family: Arial, sans-serif; background-color: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); max-width: 900px; margin: auto; position: relative;">
                    
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                        <div style="display: flex; align-items: center;">
                            <img src="/${page.image}" alt="${page.page_title}" style="width: 70px; height: 70px; border-radius: 50%; margin-right: 15px;">
                            <h2 style="font-size: 32px; font-weight: 700; color: #0C5097; margin: 0;">${page.page_title}</h2>
                        </div>
                        <span style="font-size: 14px; color: #888;">Last updated on: ${new Date(page.updated_at).toLocaleDateString('en-GB', {
                            day: '2-digit', month: 'short', year: 'numeric'
                        })}</span>
                    </div>

                    <p style="font-size: 16px; line-height: 1.7; color: #333; margin-bottom: 15px;">
                        ${page.page_description}
                    </p>

                    ${
                        page.page_points
                            ? `<ul style="padding-left: 20px; color: #333; margin-bottom: 30px;">
                                    ${page.page_points.split('\n').map(point => `<li style="margin-bottom: 6px;">${point}</li>`).join('')}
                               </ul>`
                            : ''
                    }

                    <div style="text-align: center; margin-top: 40px;">
                        <button onclick="editPage(${page.id})"
                            style="background-color: #0C5097; color: #fff; border: none; border-radius: 50px; padding: 14px 40px; font-size: 18px; font-weight: bold; cursor: pointer; margin-right: 15px;">
                            <i class="fas fa-edit"></i> Edit Content
                        </button>
                        <button onclick="confirmDelete(${page.id})"
                            style="background-color: #d9534f; color: #fff; border: none; border-radius: 50px; padding: 14px 40px; font-size: 18px; font-weight: bold; cursor: pointer;">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </div>
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





<script>
    // Get teams data from backend
    const teamsData = @json($teams);

    // When a team from the dropdown is clicked
    document.querySelectorAll('.team-option').forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();

            const teamId = this.getAttribute('data-team-id');
            const teamName = this.getAttribute('data-team-name');

            // Update dropdown button text
            document.getElementById('selectedTeam').innerText = teamName;

            // Remove "active" class from all dropdown items
            document.querySelectorAll('.team-option').forEach(opt => {
                opt.classList.remove('active');
                opt.style.backgroundColor = ''; 
                opt.style.color = '';
            });

            // Add "active" class to the selected team item
            this.classList.add('active');
            this.style.backgroundColor = '#0C5097';
            this.style.color = 'white';

            // Load users
            const container = document.getElementById('teamUsersContainer');
            container.innerHTML = ''; // Clear old users

            const selectedTeam = teamsData.find(team => team.id == teamId);

            if (selectedTeam && selectedTeam.users.length > 0) {
                selectedTeam.users.forEach(user => {
                    const userHTML = `
                        <div class="col-md-6 mt-3">
                            <div style="display: flex;">
                                <div>
                                    <img src="${user.profile_image ? '/' + user.profile_image : '/images/avatar.png'}"
                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 100px;" alt="">
                                </div>
                                <div style="padding-top: 10px; padding-left: 5px;">
                                    <p style="font-size: 14px;font-weight: bold;margin-bottom: 3px;color:black;">
                                        ${user.name}
                                        <span
                                            style="background: #0C5097; color: white; font-size: 8px; padding: 1px 4px 2px 4px; border-radius: 10px;">
                                            ${user.role ?? 'Member'}
                                        </span>
                                    </p>
                                    <p style="font-size: 14px;color: #0C5097; font-weight: 500;">
                                        ${user.designation ?? 'Team Member'}, ${selectedTeam.team_name}
                                    </p>
                                </div>
                            </div>
                        </div>
                    `;
                    container.innerHTML += userHTML;
                });
            } else {
                container.innerHTML = `<p class="text-muted ps-3 mt-2">No users found for this team.</p>`;
            }
        });
    });
</script>
<script>
    document.querySelectorAll(".dropdown-item").forEach((item) => {
    item.addEventListener("click", (e) => {
        e.preventDefault();
        const target = e.target.getAttribute("data-target");
        const teamId = e.target.getAttribute("data-team-id"); // optional, if you have one

        document.getElementById("dropdownMenuButton").innerText = e.target.innerText;

        if (target === "team") {
            // Instead of new route — reuse your existing /get-page-records endpoint
            fetch(`/get-page-records/${teamId}`) 
                .then(response => response.json())
                .then(data => {
                    let section = document.getElementById("pageDetails");
                    document.querySelector(".welcome").style.display = "none";
                    section.style.display = "block";

                    if (data.length > 0) {
                        let team = data[0];
                        section.innerHTML = `
                            <h4>${team.team_name ?? 'Team'}</h4>
                            <p>${team.team_description ?? 'No description available.'}</p>
                            <hr>
                            <h5>Pages</h5>
                            <ul>
                                ${data.map(page => `
                                    <li onclick="loadPage(${page.id})">${page.page_title}</li>
                                `).join('')}
                            </ul>
                        `;
                    } else {
                        section.innerHTML = `<p>No data found for this team.</p>`;
                    }
                })
                .catch(err => console.error("Error loading team data:", err));
        }
    });
});
function loadPage(pageId) {
    fetch(`/get-page-records/${pageId}`)
        .then(res => res.json())
        .then(data => {
            let page = data[0];
            let section = document.getElementById("pageDetails");
            section.innerHTML = `
                <h4>${page.page_title}</h4>
                <img src="/${page.image}" style="width:15%" />
                <p>${page.page_description}</p>
            `;
        })
        .catch(err => console.error(err));
}

</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const documentSection = document.getElementById("document-main");
    const teamSection = document.getElementById("team-main");
    const docButton = document.getElementById("showDocumentsBtn");

    // Hide document section by default
    documentSection.style.display = "none";

    // Add click event to "Documents" button
    docButton.addEventListener("click", function () {
        documentSection.style.display = "block";   // Show document section
        teamSection.style.display = "none";        // Hide team section
    });
});
</script>


@endpush
