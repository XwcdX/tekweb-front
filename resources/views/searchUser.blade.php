<div>
    <input
        type="text"
        id="searchInput"
        placeholder="Search users..."
        oninput="searchInput(event)" />
    <div id="searchResult"></div>
</div>

<style>
    #searchInput {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        margin-bottom: 10px;
    }

    #searchResult {
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

@include('utils.trie')

<script>

let users = <?php echo json_encode($users)?>;

const trie = new Trie();

for(let i = 0; i < users.length; i++){ //Masukkan data ke Node"
    trie.insert(users[i]['username'].toLowerCase())
}

function searchInput(){
    const input = document.getElementById('searchInput').value.toLowerCase();
    const resultsDiv = document.getElementById('searchResult'); 
    if (input.length > 0){
        const results = trie.search(input);        
        resultsDiv.innerHTML = results.map(result => `<div class="result-item">${result}</div>`).join('');
    }else{
        resultsDiv.innerHTML = '';
    }

}
</script>