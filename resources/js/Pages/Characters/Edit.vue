<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Character
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <form @submit.prevent="submit">
                        <p class="mb-4">
                            <label for="name">Name</label><br/>
                            <input type="text" name="name" id="name" v-model="form.name" autofocus
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                        </p>

                        <p class="mb-4">
                            <label for="name">Island</label><br/>
                            <select name="island_id" id="island_id" size="1" v-model="form.island_id"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option v-for="(island,index) in islands" :value="island.id">{{ island.name }}</option>
                            </select>
                        </p>

                        <div class="mb-4">
                            <table>
                                <thead>
                                    <tr>
                                        <td width="60%">
                                            <label for="name">Add item</label><br/>
                                        </td>
                                        <td width="15%">
                                            <label for="price-sell">Sells at</label><br/>
                                        </td>
                                        <td width="15%">
                                            <label for="price-buy">Buys at</label><br/>
                                        </td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4">
                                            <div class="items-filter mb-4">
                                                <input type="text" name="filter" id="filter" ref="filter" placeholder="Filter" v-model="itemNameFilter" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="60%">
                                            <select name="item-id" id="item-id" size="1" v-model="itemId"
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                <option v-for="(item,index) in filteredUnassignedItems" :value="item.id">{{
                                                        item.name
                                                    }}
                                                </option>
                                            </select>
                                        </td>
                                        <td width="15%">
                                            <input type="number" name="price-sell" id="price-sell" v-model="priceSell"
                                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                                        </td>
                                        <td width="15%">
                                            <input type="number" name="price-buy" id="price-buy" v-model="priceBuy" @blur="addItem"
                                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                                        </td>
                                        <td width="10%">
                                            <span @click="addItem"
                                                  class="bg-white hover:bg-gray-100 text-gray-800 font-semibold px-2 border border-gray-400 rounded shadow">
                                                +
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="assigned-items mb-4" v-if="assignedItems.length > 0">
                            <label for="name">Assigned items</label><br/>
                            <div class="assigned-item" v-for="(item, index) in sortedAssignedItems">
                                <span @click="removeItem(index)"
                                      class="bg-white hover:bg-gray-100 text-gray-800 font-semibold px-1 border border-gray-400 rounded shadow">-</span>

                                {{ item.name }} ({{ item.pivot.priceSell }} / {{ item.pivot.priceBuy }})
                            </div>
                        </div>

                        <p>
                            <button type="submit"
                                    class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                Save
                            </button>
                            <a :href="route('characters.index')"
                               class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Cancel</a><br/>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    props: [
        'character',
        'islands',
        'items',
        'assignedItems',
    ],

    components: {
        AppLayout,
    },

    data() {
        return {
            form: {
                name: '',
                island_id: 0,
                assigned_items: [],
            },
            itemId: 0,
            itemNameFilter: '',
            priceBuy: 0,
            priceSell: 0,
        }
    },

    computed: {
        assignedItemIds() {
            return this.form.assigned_items.map(item => {
                return item.id;
            });
        },

        filteredUnassignedItems() {
            let unassignedItems = this.unassignedItems.filter(item => item.name.toLowerCase().includes(this.lowercaseFilter));
            this.itemId = unassignedItems.length > 0 ? unassignedItems[0].id : 0;

            return unassignedItems;
        },

        lowercaseFilter() {
            return this.itemNameFilter.toLowerCase();
        },

        unassignedItems() {
            return this.items.filter(item => !this.assignedItemIds.includes(item.id));
        },

        sortedAssignedItems() {
            return this.form.assigned_items.sort((a, b) => (a.name > b.name) ? 1 : ((b.name > a.name) ? -1 : 0));
        },
    },

    methods: {
        addItem() {
            /* Return early if no item is selected */

            if (!this.itemId || (parseInt(this.priceBuy, 10) === 0 && parseInt(this.priceSell, 10) === 0)) {
                return;
            }

            /* Add item */

            let item = this.getItemById(this.itemId);
            item.pivot = {};
            item.pivot.priceBuy = this.priceBuy;
            item.pivot.priceSell = this.priceSell;

            this.form.assigned_items.push(item);

            /* Reset form */

            this.itemId = this.unassignedItems[0].id;
            this.priceBuy = 0;
            this.priceSell = 0;

            /* Set focus on filter field */

            this.$refs.filter.focus();
        },

        getItemById(id) {
            return this.items.filter(item => item.id === id)[0];
        },

        removeItem(index) {
            this.form.assigned_items.splice(index, 1);
        },

        submit() {
            this.$inertia.put(route('characters.update', [this.character.id,]), this.form)
        },
    },

    created()
    {
        this.itemId = this.unassignedItems[0].id;
    },

    mounted()
    {
        this.form.name = this.character.name;
        this.form.island_id = this.character.island_id;
        this.form.assigned_items = this.assignedItems;
    },
}
</script>
