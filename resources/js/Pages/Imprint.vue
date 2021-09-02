<template>
    <div class="min-h-screen">

        <LandingHeader></LandingHeader>

        <div class="container min-h-[60vh] ">

            <section class="max-w-prose	mx-auto">
                <h1>Imprint / Impressum</h1>
                <h2>Angaben gemäß § 5 TMG<br></h2>
                <h3>Büroanschrift</h3>
                <p><strong>webhub GmbH</strong><br>Neuer Markt 13 (Eingang Kröpeliner Str. 3)<br>18055 Rostock<br>Tel:
                    <a href="tel:038136768606">0381-36768606</a><br></p>
                <h3>Firmenanschrift</h3>
                <p><strong>webhub GmbH</strong><br>Hasselbruch 28<br>18059 Rostock</p>
                <p><strong>Geschäftsführer<br></strong>Johannes Ahrndt - <a href="mailto:ahrndt@webhub.de">ahrndt@webhub.de<br></a>Marten
                    Brosch - <a href="mailto:brosch@webhub.de">brosch@webhub.de</a></p>
                <p><strong>Amtsgericht Rostock</strong>, HRB 14629</p>
                <p><strong>USt.-IdNr.:</strong> DE325666235<br></p>
                <p><strong>Inhaltlich verantwortlich gemäß § 18. MStV: </strong>Johannes Ahrndt und Marten Brosch</p>
                <h2>Online-Streitbeilegung</h2>
                <p>Die Europäische Kommission stellt unter <a href="https://ec.europa.eu/consumers/odr/">https://ec.europa.eu/consumers...</a>
                    eine Plattform zur Online-Streitbeilegung bereit, die Verbraucher für die Beilegung einer
                    Streitigkeit nutzen können und auf der weitere Informationen zum Thema Streitschlichtung zu finden
                    sind.</p>
                <h2>Außergerichtliche Streitbeilegung</h2>
                <p>Wir sind weder verpflichtet noch dazu bereit, im Falle einer Streitigkeit mit einem Verbraucher an
                    einem Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.</p></section>

        </div>

        <BaseFooter></BaseFooter>
    </div>
</template>

<script>

import BaseFooter from "../Components/BaseFooter";
import LandingRectangles from "../Components/LandingRectangles";
import LandingHeader from "../Components/LandingHeader";


export default {
    components: {LandingHeader, LandingRectangles, BaseFooter},
    methods: {
        createNew() {
            this.$inertia.post(route('configuration.store'));
        }
    }
}
</script>
