<template>
    <v-main
        style="
            background-image: url('images/cervene_pozadi.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        "
    >
        <div style="position: absolute; top: 35%; left: 35%">
            <h1 class="text-h2 font-weight-medium text-center text-white">
                404 stránka nenalezena
                <br />
                <v-btn :to="'/'" class="mx-auto" prepend-icon="mdi-home">
                    Zpět domů
                </v-btn>
            </h1>
        </div>
    </v-main>
</template>
