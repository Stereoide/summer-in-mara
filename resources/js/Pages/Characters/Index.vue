<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Characters
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div v-if="characters.length === 0">No characters created yet</div>

                    <div class="characters mb-4" v-if="characters.length !== 0">
                        <div class="items-filter mb-4">
                            <label for="filter">Filter</label><br/>
                            <input type="text" name="filter" id="filter" v-model="filter" autofocus class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                        </div>

                        <div class="character" v-for="(character, index) in filteredCharacters">
                            <a :href="route('characters.edit', [character.id])">{{ character.name }} / {{ character.island.name }}</a>
                        </div>
                    </div>

                    <p>
                        <a :href="route('characters.create')" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Add character</a>
                    </p>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    props: [
        'characters'
    ],

    components: {
        AppLayout,
    },

    data() {
        return {
            filter: '',
        }
    },

    computed: {
        filteredCharacters() {
            return this.characters.filter(character => character.name.toLowerCase().includes(this.lowercaseFilter) || character.island.name.toLowerCase().includes(this.lowercaseFilter));
        },

        lowercaseFilter() {
            return this.filter.toLowerCase();
        },
    },

    methods: {}
}
</script>
