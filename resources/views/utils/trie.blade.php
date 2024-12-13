<script>
    class TrieNode {
    constructor() {
        this.children = {}; 
        this.isEndOfWord = false; 
    }
}

class Trie {
    constructor() {
        this.root = new TrieNode(); 
    }

    insert(word) {
        let currentNode = this.root; 
        for (const char of word) {
            if (!currentNode.children[char]) {
                currentNode.children[char] = new TrieNode();
            }
            currentNode = currentNode.children[char];
        }
        currentNode.isEndOfWord = true; 
    }

    searchPrefix(prefix) {
        let currentNode = this.root; 
        for (const char of prefix) {
            if (!currentNode.children[char]) {
                return null;
            }
            currentNode = currentNode.children[char];
        }
        return currentNode;
    }

    search(prefix) {
        const result = [];
        const prefixNode = this.searchPrefix(prefix);

        if (!prefixNode) return result; 

        const collectWords = (node, path) => {
            if (node.isEndOfWord) {
                result.push(path);
            }
            for (const char in node.children) {
                collectWords(node.children[char], path + char);
            }
        };

        collectWords(prefixNode, prefix);
        return result;
    }
}
</script>