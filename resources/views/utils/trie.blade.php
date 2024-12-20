<script>
class AVLNode {
    constructor(key) {
        this.key = key;
        this.left = null;
        this.right = null;
        this.height = 1;
        this.trieNode = new TrieNode();
    }
}

class AVLTree {
    constructor() {
        this.root = null;
    }

    getHeight(node) {
        return node ? node.height : 0;
    }

    getBalance(node) {
        return node ? this.getHeight(node.left) - this.getHeight(node.right) : 0;
    }

    rightRotate(y) {
        const x = y.left;
        const T2 = x.right;

        x.right = y;
        y.left = T2;

        y.height = Math.max(this.getHeight(y.left), this.getHeight(y.right)) + 1;
        x.height = Math.max(this.getHeight(x.left), this.getHeight(x.right)) + 1;

        return x;
    }

    leftRotate(x) {
        const y = x.right;
        const T2 = y.left;

        y.left = x;
        x.right = T2;

        x.height = Math.max(this.getHeight(x.left), this.getHeight(x.right)) + 1;
        y.height = Math.max(this.getHeight(y.left), this.getHeight(y.right)) + 1;

        return y;
    }

    insert(node, key) {
        if (!node) return new AVLNode(key);
        if (key < node.key) {
            node.left = this.insert(node.left, key);
        } else if (key > node.key) {
            node.right = this.insert(node.right, key);
        } else {
            return node;
        }

        node.height = Math.max(this.getHeight(node.left), this.getHeight(node.right)) + 1;

        const balance = this.getBalance(node);

        if (balance > 1 && key < node.left.key) return this.rightRotate(node);
        if (balance < -1 && key > node.right.key) return this.leftRotate(node);
        if (balance > 1 && key > node.left.key) {
            node.left = this.leftRotate(node.left);
            return this.rightRotate(node);
        }
        if (balance < -1 && key < node.right.key) {
            node.right = this.rightRotate(node.right);
            return this.leftRotate(node);
        }

        return node;
    }

    search(node, key) {
        if (!node || node.key === key) return node;
        if (key < node.key) return this.search(node.left, key);
        return this.search(node.right, key);
    }

    add(key) {
        this.root = this.insert(this.root, key);
    }

    find(key) {
        return this.search(this.root, key);
    }

    collect(node, prefix, result) {
        if (!node) return;
        if (node.key.startsWith(prefix)) result.push(node.key);

        this.collect(node.left, prefix, result);
        this.collect(node.right, prefix, result);
    }

    searchPrefix(prefix) {
        const result = [];
        this.collect(this.root, prefix, result);
        return result;
    }
}

class TrieNode {
    constructor() {
        this.children = new AVLTree();
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
            let childNode = currentNode.children.find(char)?.trieNode;
            if (!childNode) {
                currentNode.children.add(char);
                childNode = currentNode.children.find(char).trieNode;
            }
            currentNode = childNode;
        }
        currentNode.isEndOfWord = true;
    }

    searchPrefix(prefix) {
        let currentNode = this.root;
        for (const char of prefix) {
            const childNode = currentNode.children.find(char)?.trieNode;
            if (!childNode) return null;
            currentNode = childNode;
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
            node.children.searchPrefix("").forEach((char) => {
                collectWords(node.children.find(char).trieNode, path + char);
            });
        };

        collectWords(prefixNode, prefix);
        return result;
    }
}
</script>