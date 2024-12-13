<script>
    class TrieNode {
    constructor() {
        this.children = {}; // Holds child nodes as key-value pairs
        this.isEndOfWord = false; // Marks if a word ends at this node
    }
}

// Trie Class
class Trie {
    constructor() {
        this.root = new TrieNode(); // Root node of the Trie
    }

    // Insert a word into the Trie
    insert(word) {
        let currentNode = this.root; // Start from the root node
        for (const char of word) {
            // If the character is not in the children, add it
            if (!currentNode.children[char]) {
                currentNode.children[char] = new TrieNode();
            }
            currentNode = currentNode.children[char]; // Move to the child node
        }
        currentNode.isEndOfWord = true; // Mark the end of the word
    }

    // Search for a word or prefix in the Trie
    searchPrefix(prefix) {
        let currentNode = this.root; // Start from the root
        for (const char of prefix) {
            // If the character is not in the children, prefix doesn't exist
            if (!currentNode.children[char]) {
                return null;
            }
            currentNode = currentNode.children[char]; // Move to the next node
        }
        return currentNode; // Return the last node for the prefix
    }

    // Retrieve all words with a given prefix
    search(prefix) {
        const result = [];
        const prefixNode = this.searchPrefix(prefix);

        if (!prefixNode) return result; // If prefix doesn't exist, return empty list

        // Helper function to traverse and collect words
        const collectWords = (node, path) => {
            if (node.isEndOfWord) {
                result.push(path); // Add the complete word to results
            }
            for (const char in node.children) {
                collectWords(node.children[char], path + char); // Recurse
            }
        };

        collectWords(prefixNode, prefix); // Start traversal from the prefix node
        return result;
    }
}
</script>