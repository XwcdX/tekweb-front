@extends('layout')
@section('content')
@include('partials.nav')
@include('utils.background2')

<style>
    .profile-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        max-width: 600px;
        margin: auto;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .profile-picture-container {
        position: relative;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        margin: 1rem 0;
    }

    .profile-picture-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-picture-container button {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background-color: white;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: background-color 0.2s ease-in-out;
    }

    .profile-picture-container button:hover {
        background-color: #f0f0f0;
    }

    .form-field {
        width: 100%;
        max-width: 500px;
        margin-bottom: 1.5rem;
    }

    .form-field label {
        display: block;
        font-size: 1rem;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .form-field input,
    .form-field textarea {
        width: 100%;
        padding: 0.75rem;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 1rem;
        transition: border-color 0.2s ease-in-out;
    }

    .form-field input:focus,
    .form-field textarea:focus {
        border-color: #7494ec;
        outline: none;
    }


    .buttons-container button {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: bold;
        color: white;
        border: none;
        background-color: #7494ec;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .buttons-container button:hover {
        background-color: #485d93;
    }

    @media (max-width: 768px) {
        .form-field {
            max-width: 100%;
        }

        .buttons-container {
            flex-direction: column;
            gap: 0.5rem;
        }
    }
</style>

<div class="text-gray-900 min-h-screen pt-20 px-4">
    <div class="profile-container">
        <h1 class="text-[#7494ec] text-4xl font-bold text-center">Edit Profile</h1>

        <!-- Profile Picture -->
        <div class="profile-picture-container" id="upload-profile">
            <img id="profile-img" src="https://via.placeholder.com/150" alt="Profile Picture">
            <button>
                <i class="fas fa-edit text-gray-700"></i>
            </button>
            <!-- Hidden file input -->
            <input type="file" id="profile-input" class="hidden" accept="image/*">
        </div>

        <!-- Username Field -->
        <div class="form-field">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ $user['username'] }}">
        </div>

        <!-- Biodata Field -->
        <div class="form-field">
            <label for="biodata">Biodata</label>
            <textarea id="biodata" name="biodata" rows="5">{{ $user['biodata'] }}</textarea>
        </div>

        <!-- Buttons -->
        <div class="buttons-container">
            <button type="submit" class="mr-4">
                <a href="#route save profile">Save</a>
            </button>
            <button type="button">
                <a href="{{ route('seeProfile') }}">Cancel</a>
            </button>
        </div>
    </div>
</div>

<script>
    // Trigger file input when profile picture is clicked
    document.getElementById('upload-profile').addEventListener('click', function () {
        document.getElementById('profile-input').click();
    });

    // Handle profile picture upload
    document.getElementById('profile-input').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('profile-img').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
