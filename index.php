<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <title>Shopping List App</title>
</head>

<body>

    <div class="container">
        <div id="shopping-list">
            <div class="header">
                <h1>{{ header.toLocaleUpperCase() }}</h1>
                <button v-if="state === 'default'" class="btn btn-primary" @click="changeState('edit')">Add Item</button>
                <button v-else class="btn btn-danger" @click="changeState('default')">Cancel</button>
            </div>
            <br>
            <div class="add-item-form" v-if="state === 'edit'">
                <input v-model="newItem" type="text" placeholder="Add an item" @keyup.enter="saveItem">
                <button class="btn btn-primary" :disabled="newItem.length === 0"  @click="saveItem">Save Item</button>
            </div>
            <ul>
                <li v-for="item in reversedItems" :class="{strikeout: item.purchased}" @click="togglePurchased(item)">{{ item.label }}</li>
            </ul>
            <p v-if="items.length === 0">No Items in this list so far!</p>
        </div>
    </div>
    <script src="https://unpkg.com/vue"></script>
    <script>
        var shoppingList = new Vue({
            el: '#shopping-list',
            data: {
                state: 'default',
                header: 'shopping list app',
                newItem: '',
                items: [
                    {
                        label: '10 party hats',
                        purchased: false,
                        highPriority: false,
                    },
                    {
                        label: '2 board games',
                        purchased: true,
                        highPriority: false,
                    },
                    {
                        label: '20 cups',
                        purchased: false,
                        highPriority: true
                    },
                ]
            },
            computed: {
                reversedItems() {
                    return this.items.slice(0).reverse();
                }
            },
            methods: {
                saveItem: function() {
                    this.items.push({
                        label: this.newItem,
                        purchased: false,
                    },);
                    this.newItem = '';
                },
                changeState: function(newState) {
                    this.state = newState;
                    this.newItem = '';
                },
                togglePurchased: function(item) {
                    item.purchased = !item.purchased;
                }
            }
        });
    </script>

</body>

</html>