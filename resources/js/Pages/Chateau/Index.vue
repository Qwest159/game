<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import tableau_niv_coul from "@/Components/CouleurNiveau.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, defineProps, defineEmits } from "@vue/runtime-core";

// const emit = defineEmits(["mont"]);

const props = defineProps(["hero_user", "hero_user_up"]);

// let message_gain = ref([or]);

let message_afficher = ref("");
</script>

<template>
    <AppLayout title="Exterieur">
        <main class="h-screen pt-16 bg-black content-center" id="chateau">
            <section
                id="section_chateau_hero"
                class="bg-white h-3/5 w-3/5 m-auto"
            >
                <article>
                    <div class="border-2 grid p-2 rounded-xl">
                        <h1 class="font-bold mb-2">Soignez son héros</h1>
                        <button
                            v-if="
                                hero_user.caract_hero.hp != hero_user.hp_restant
                            "
                            class="bg-green-500 text-white font-bold p-2 rounded-xl"
                            @click="
                                () =>
                                    $inertia.post(
                                        route('restaurez_vie', {
                                            hero_id: hero_user.id,
                                            hp_full: hero_user.caract_hero.hp,
                                        })
                                    )
                            "
                        >
                            Restaurez sa vie
                        </button>
                        <button
                            v-else
                            class="bg-green-500 text-white font-bold p-2 rounded-xl"
                        >
                            Vie pleine
                        </button>
                    </div>
                </article>

                <!-- -----LEVEL UP ----- -->
                <article class="">
                    <h1 class="text-center font-bold">Level up</h1>
                    <div class="grid grid-cols-2 gap-6">
                        <table class="rounded-b-xl">
                            <tbody>
                                <tr class="skill text-xl font m-auto pb-2">
                                    <td class="">{{ hero_user.role }}</td>
                                </tr>
                                <tr class="skill text-xl font pb-2 m-auto">
                                    <td class="font-bold text-center">
                                        Niveau
                                    </td>
                                    <td
                                        :class="
                                            tableau_niv_coul[hero_user.niveau]
                                        "
                                        id="niveau"
                                    >
                                        {{ hero_user.niveau }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="self-center">HP</td>
                                    <td class="text-center">
                                        <p class="">
                                            {{ hero_user.hp_restant }}
                                        </p>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td>ATT</td>
                                    <td class="text-center">
                                        {{ hero_user.caract_hero.att }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>DEF</td>
                                    <td class="text-center">
                                        {{ hero_user.caract_hero.def }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="self-center">EXP</td>
                                    <td class="text-center">
                                        <p class="" v-if="props.hero_user_up">
                                            {{
                                                hero_user.caract_hero.exp_requis
                                            }}
                                        </p>
                                        <p
                                            v-else
                                            class="text-red-600 font-bold text-center"
                                        >
                                            Max
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- ---- LEVEL UP --- -->
                        <table v-if="props.hero_user_up" class="rounded-b-xl">
                            <tbody>
                                <tr class="skill text-xl font m-auto pb-2">
                                    <td class="">
                                        {{ hero_user_up.role.role }}
                                    </td>
                                </tr>
                                <tr class="skill text-xl font pb-2 m-auto">
                                    <td class="font-bold text-center">
                                        Niveau
                                    </td>
                                    <td
                                        :class="
                                            tableau_niv_coul[
                                                hero_user_up.niveau
                                            ]
                                        "
                                        id="niveau"
                                    >
                                        {{ hero_user_up.niveau }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="self-center">HP</td>
                                    <td class="text-center">
                                        <p>{{ hero_user_up.hp }}</p>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td>ATT</td>
                                    <td class="text-center">
                                        {{ hero_user_up.att }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>DEF</td>
                                    <td class="text-center">
                                        {{ hero_user_up.def }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="self-center">EXP</td>
                                    <td class="text-center">
                                        <p class="">
                                            {{
                                                hero_user.caract_hero.exp_requis
                                            }}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center w-full" v-if="props.hero_user_up">
                        <button
                            v-if="
                                hero_user.exp_restant >=
                                hero_user.caract_hero.exp_requis
                            "
                            class="bg-green-500 text-white font-bold p-2 rounded-xl"
                            @click="
                                () =>
                                    $inertia.post(
                                        route('level_up', {
                                            hero_id: hero_user.id,
                                            caract_hero_id: hero_user_up.id,
                                            exp_requis:
                                                hero_user.caract_hero
                                                    .exp_requis,
                                        })
                                    )
                            "
                        >
                            Level up
                        </button>
                        <button
                            v-else
                            class="bg-green-500 text-white font-bold p-2 rounded-xl"
                        >
                            Insuffisant xp
                        </button>
                    </div>
                </article>
            </section>
            <section class="grid grid-cols-3 relative">
                <p
                    v-if="message_afficher"
                    id="message_info"
                    class="bg-red-600 justify-self-center px-2 text-white font-extrabold text-2xl text-center absolute z-10 rounded-xl"
                >
                    {{ message_afficher }}
                </p>
            </section>
        </main>
    </AppLayout>
</template>
