<div>
    <input
        type="text"
        id="search-input"
        placeholder="Search users..."
        oninput="onSearchInput(event)" />
    <div id="search-results"></div>
</div>

<style>
    #search-input {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        margin-bottom: 10px;
    }

    #search-results {
        border: 1px solid #ccc;
        max-height: 200px;
        overflow-y: auto;
    }

    .result-item {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
    }

    .result-item:hover {
        background-color: #f0f0f0;
    }
</style>

<script>
    // AJAX search
    function onSearchInput(event) {
        const query = event.target.value.toLowerCase();

        //query to backend, results as JSON
        fetch(`/search-user?query=${query}`)
            .then(response => response.json())
            .then(results => {
                // Display results
                const resultsDiv = document.getElementById('search-results');
                resultsDiv.innerHTML = results.map(result => `<div class="result-item">${result}</div>`).join('');
            });
    }
</script>