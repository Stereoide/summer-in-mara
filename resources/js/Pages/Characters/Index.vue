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

                    <div class="characters" v-if="characters.length !== 0">
                        <div class="character" v-for="(character, index) in characters">
                            <a :href="route('characters.edit', [character.id])">{{ character.name }} / {{ character.island.name }}</a>
                        </div>
                    </div>

                    <p>
                        <button
                            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                            <a :href="route('characters.create')" class="btn">Add character</a>
                        </button>
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
        return {}
    },

    methods: {}
}
</script>
