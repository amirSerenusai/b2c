
<div class="mt-4">





{{--<h2>Tree View</h2>--}}
{{--<p>A tree view represents a hierarchical view of information, where each item can have a number of subitems.</p>--}}
{{--<p>Click on the arrow(s) to open or close the tree branches.</p>--}}

<ul id="tree-myUL">
    <li><span class="tree-caret">General information</span>
        <ul class="tree-nested">
            <li>The insertion of ventilating tubes also known as tympanostomy tubes is a simple operation  and the most common procedure performed by ear,
                nose, throat (ENT) specialists.
                The main goal of the operation is to equalize the pressure between the middle ear and the surrounding,
                thus preventing the formation of negative pressure and accumulation of fluids in the middle ear of patients
                (particularly children) in which the Eustachian tube does not function well.
                This fluid in the middle ear is a potential ground for recurrent infections as well as a cause for conductive hearing loss,
                and as a result - speech and language delay.
                The procedure includes small incision in the tympanic membrane (myringotomy) and the placement of pressure equalizer tubes in the tympanic membrane.
            </li>
            <li><span class="tree-caret">Indication </span>
                <ul class="tree-nested">
                    <li>Chronic accumulation of fluid in the middle (Serous otitis media) with or without recurrent infections of the middle ear). The condition of the tympanic membrane, the degree of hearing loss, the delay in language development and the number of infections are among the variables which may have influence on the decision to operate.
                    </li>
                </ul>
            </li>
            <li><span class="tree-caret">Description of the Procedure </span>
                <ul class="tree-nested">
                   <li>The insertion of ventilating tubes is a quick and a simple procedure. The main risks of the procedure are the risks associated with general anesthesia, but rarely recurrent infections can occur due to water penetration,  and  a perforation of the TM may persist after the extrusion of the tubes.
                    </li>
                </ul>
            </li>
            <li><span class="tree-caret">Recovery Time</span>
                <ul class="tree-nested">
                    <li>Usually the recovery time from the operation is a few hours depending on the influence of the anesthesia on the patient. Following the surgery, antibiotic ear drops are usually prescribed for a few days and the patient returns to full function.
                        The tubes placed in the eardrums, in most cases, are gradually extruded into the external ear canals (usually in 6-12 months). In rare cases, should they have not fallen in two or three years - they should be removed in an additional short procedure. 
                        It is important to prevent water from entering into the middle ears through the tubes by using ear plugs during baths, showers and swimming, in order to prevent infections, until the tubes fall out. 
                    </li>
                </ul>
            </li>
            <li><span class="tree-caret">Risks associated with the procedure </span>
                <ul class="tree-nested">
                    <li>Chronic accumulation of fluid in the middle (Serous otitis media) with or without recurrent infections of the middle ear). The condition of the tympanic membrane, the degree of hearing loss, the delay in language development and the number of infections are among the variables which may have influence on the decision to operate.
                    </li>
                </ul>
            </li>
            <li><span class="tree-caret">Alternative Care </span>
                <ul class="tree-nested">
                    <li>An alternative to ear tube insertion is to continue consuming conventional antibiotics and antihistamine medication while examining periodically the existence of fluid in the middle ear by an ENT specialist and checking the degree of the hearing loss. 
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</ul>

<script>
    var toggler = document.getElementsByClassName("tree-caret");
    var i;

    for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function() {
            this.parentElement.querySelector(".tree-nested").classList.toggle("tree-active");
            this.classList.toggle("tree-caret-down");
        });
    }
</script>


</div>
