<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import tableau_att_coul from "@/Components/CouleurAttaque.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, defineProps, defineEmits } from "@vue/runtime-core";

const emit = defineEmits(["montrer_bataille"]);

const props = defineProps([
    "hero_user",
    "attaques_user",
    "niveau_bataille",
    "tableau_monstre_carte",
]);
let texte = ref("");
let open_attaque = ref(false);
let open_sac = ref(false);
// ICIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII
let attaque_choisi = ref(-1);
// let attaque_choisi = ref(1);
// let form = useForm({});
let tableau_combat_monstre = ref(props.tableau_monstre_carte.monstre_choisi);

function message(texte_recu) {
    texte.value = texte_recu;

    setTimeout(() => {
        texte.value = null;
    }, 5000);
}

function combat(index_monstre_choisi) {
    // ----DONNEE ----
    let monstre_choisi = tableau_combat_monstre.value[index_monstre_choisi];
    let hero_caract = props.hero_user.caract_hero;
    let hero_hp = props.hero_user.hp_restant;

    // ----COMBAT DU HERO----
    let attaque_totale = hero_caract.att + attaque_choisi.value;
    let att_restant = attaque_totale - monstre_choisi.def;

    if (att_restant > 0) {
        monstre_choisi.hp -= att_restant;
    } else {
        console.log("Votre attaque est insufisante");
    }

    message(
        `Attaque du héro : ${attaque_totale}, Franchi le bouclier ${att_restant}, hp monstre ${monstre_choisi.hp}`
    );

    // ----RESULTAT----
    // Monstre avec hp à 0 => supprimer
    if (monstre_choisi.hp <= 0) {
        delete tableau_combat_monstre.value[index_monstre_choisi];
    }
    // -----------remise par défaut----------
    attaque_choisi.value = -1;

    // Condition de victoire (tous les monstre tués)
    // ----------GAGNER--------
    if (Object.keys(tableau_combat_monstre.value).length === 0) {
        console.log("GAGNER");

        emit("gagner_combat", {
            index: props.niveau_bataille[1],
            img: props.niveau_bataille[0].img_path,
        });

        emit("montrer_bataille", false);
    }
    // ----------ATTAQUE DU MONSTRE ------------
    // Condition pour perdre (hp du hero en dessous de °)

    if (hero_hp <= 0) {
        console.log("PERDU");
    }
}
function fuite() {
    emit("montrer_bataille", false);
}
</script>

<template>
    <section id="combat" class="h-full w-full absolute bg-black top-0">
        <figure id="arene_combat" class="m-auto relative pt-11">
            <img
                class="w-full"
                :src="`storage${props.niveau_bataille[0].img_path}`"
                alt=""
            />
            <img id="hero" :src="`storage${props.hero_user.img_path}`" alt="" />
            <div
                v-for="(monstre, index) in props.tableau_monstre_carte
                    .monstre_choisi"
            >
                <img
                    :src="`storage${monstre.img_path}`"
                    :id="`monstre${index}`"
                    class="monstre"
                    alt=""
                />
                <article
                    :id="`donnee_monstre${index}`"
                    :class="tableau_att_coul[monstre.type]"
                    class="info_monstre"
                >
                    <h3>Monstre {{ Number(index) + 1 }}</h3>
                    <div class="caract_monstre">
                        <p>HP: {{ monstre.hp }}</p>
                        <p>ATT: {{ monstre.att }}</p>
                        <p>DEF: {{ monstre.def }}</p>
                        <p>{{ monstre.type }}</p>
                    </div>
                </article>
            </div>
        </figure>
        <article id="barre_attaque" class="bg-gray-700 m-auto mt-2 p-1">
            <div v-if="attaque_choisi < 0 && !texte" class="grid grid-cols-2">
                <button @click="attaque_choisi = 0" class="bg-white">
                    Attaque</button
                ><button @click="open_sac = true" class="bg-white">Sac</button
                ><button class="bg-white">Truc</button
                ><button @click="fuite()" class="bg-white">Fuite</button>
            </div>
            <div
                v-if="attaque_choisi === 0"
                class="grid grid-cols-2 z-10 relative"
            >
                <button @click="attaque_choisi = -1" class="z-20 retour">
                    Retour
                </button>
                <button
                    v-for="attaque in attaques_user"
                    :class="tableau_att_coul[attaque.type]"
                    @click="attaque_choisi = attaque.att"
                >
                    {{ attaque.nom }}, {{ attaque.att }}
                </button>
            </div>
            <div v-if="attaque_choisi > 0" class="grid grid-cols-2 relative">
                <button @click="attaque_choisi = -1" class="z-20 retour">
                    Retour
                </button>
                <button
                    class="flex bg-white justify-center"
                    v-for="(monstre, index) in tableau_combat_monstre"
                    @click="combat(index)"
                    :class="`button_choisi${index}`"
                >
                    <p>Monstre {{ Number(index) + 1 }}</p>
                    <img
                        :src="`storage${monstre.img_path}`"
                        class="monstre_choisi"
                        alt=""
                    />
                    <p>{{ monstre.hp }}</p>
                </button>
            </div>
            <div class="">
                <p class="text-red-600 z-30">
                    {{ texte }}
                </p>
            </div>
        </article>

        <!-- <p
                id="croix"
                @click="montrer_disparait(), emit('ref_devis_disparait', false)"
            >
                ❌
            </p> -->

        <!-- <section class="flex justify-between gap-6 top-16 left-0 absolute">
                <p>JE SUIS COMBAT</p>
                <figure class="">
                    <img
                        class="w-full rounded-t-xl"
                        :src="`/storage${hero_user.portrait}`"
                        alt=""
                    />

                    <table class="rounded-b-xl">
                        <tr class="non justify-self-center font-bold mb-2">
                            {{
                                hero_user.role
                            }}
                        </tr>

                        <tr class="non text-xl font pb-2 text-center">
                            <span class="font-bold">Niveau</span>
                            <span
                                :class="tableau_niv_coul[hero_user.hero.niveau]"
                                id="niveau"
                                >{{ hero_user.hero.niveau }}</span
                            >
                        </tr>

                        <tr class="">
                            <td>HP</td>
                            <td>{{ hero_user.hero.hp }}</td>
                        </tr>
                        <tr>
                            <td>ATT</td>
                            <td>{{ hero_user.hero.att }}</td>
                        </tr>
                        <tr>
                            <td>DEF</td>
                            <td>{{ hero_user.hero.def }}</td>
                        </tr>
                        <tr>
                            <td>EXP</td>
                            <td>{{ hero_user.hero.exp }}</td>
                        </tr>
                    </table>
                </figure>
            </section> -->

        <!-- <section class="bg-white w-6/12 h-3/6 m-auto"></section> -->
    </section>
</template>
