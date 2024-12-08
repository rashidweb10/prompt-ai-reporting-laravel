
<div class="container">
    <h1>Generate Dynamic Report</h1>
    <form method="POST" action="{{ route('report.generate') }}">
        @csrf
        <div class="form-group">
            <label for="prompt">Prompt</label>
            <textarea id="prompt" name="prompt" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="api">Select API</label>
            <select id="api" name="api" class="form-control" required>
                <option value="gemini">Google Gemini</option>
                <option value="gpt">GPT (OpenAI)</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Generate Report</button>
    </form>
</div>

<style>
    /* Container styling */
.container {
    max-width: 600px; /* Limit the container width */
    margin: 0 auto; /* Center the container */
    padding: 30px; /* Add padding inside the container */
    background-color: #f8f9fa; /* Light background color */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow effect */
}

/* Heading styling */
h1 {
    text-align: center;
    color: #343a40; /* Dark text color */
    margin-bottom: 30px; /* Space below the heading */
}

/* Label styling */
label {
    font-weight: bold;
    color: #495057; /* Slightly muted dark color for labels */
}

/* Textarea styling */
textarea.form-control {
    height: 150px; /* Set fixed height for the textarea */
    resize: vertical; /* Allow vertical resizing */
    border-radius: 4px; /* Rounded corners */
    border: 1px solid #ced4da; /* Light border */
    font-size: 1rem; /* Standard font size */
    width:100%;
}

/* Select dropdown styling */
select.form-control {
    height: 45px; /* Ensure the dropdown is consistent in height */
    border-radius: 4px; /* Rounded corners */
    border: 1px solid #ced4da; /* Light border */
    width:100%;
}

/* Button styling */
button.btn-primary {
    width: 100%; /* Make the button take full width */
    padding: 10px; /* Add padding to the button */
    font-size: 1.1rem; /* Slightly larger font */
    background-color: #007bff; /* Bootstrap blue color */
    border: none; /* Remove border */
    border-radius: 4px; /* Rounded corners */
    color: white; /* White text */
}

button.btn-primary:hover {
    background-color: #0056b3; /* Darker blue on hover */
    cursor: pointer; /* Pointer cursor for better UX */
}

/* Form group spacing */
.form-group {
    margin-bottom: 20px; /* Space between form groups */
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .container {
        padding: 20px; /* Less padding on smaller screens */
    }

    textarea.form-control {
        height: 120px; /* Reduce height of textarea on small screens */
    }
}

</style>
