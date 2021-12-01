

const userMemberFormPart = document.getElementById('registration_form_userMember');

//const userMembershipTypeChoices = document.getElementById('choice-register').querySelectorAll('div');

// TODO: Récupérer la div correspondant aux champs de l'entreprise 
const userEnterpriseFormPart = document.getElementById('registration_form_userEnterprise');

/* userMembershipTypeChoices.forEach(function(item) {
    item.addEventListener('click', function(e) {
        if(e.currentTarget.id === 'register-enterprise') {
            userMemberFormPart.style.display = 'none';
            // TODO: Montrer les champs de l'entreprise
            userEnterpriseFormPart.style.display = 'block';
        }

        if(e.currentTarget.id === 'register-member') {

            userMemberFormPart.style.display = 'block';
            // TODO: Cacher les champs de l'entreprise
            userEnterpriseFormPart.style.display = 'none';
        }

    });
}) */

    
       
   const register = {


    init: function () {
        console.log('Je suis la!')
        let searchParams = new URLSearchParams(window.location.search);
        console.log(searchParams);
        if (searchParams.has('role')) {
            let param = searchParams.get('sent');
            console.log('param = ',param);
        }

        const userMemberFormPart = document.getElementById('registration_form_userMember');
        const userEnterpriseFormPart = document.getElementById('registration_form_userEnterprise');
        
        var param="<?php Print($_GET['maVaribleSurlURL']); ?>";
        
        if(param === 'enterprise') {
            userMemberFormPart.style.display = 'none';
            // TODO: Montrer les champs de l'entreprise
            userEnterpriseFormPart.style.display = 'block';
        }

        if(param=== 'member')  {

            userMemberFormPart.style.display = 'block';
            // TODO: Cacher les champs de l'entreprise
            userEnterpriseFormPart.style.display = 'none';
        };

   
    }
  }
  
  
  // On lance la fonction init uniquement quand le DOM aura terminé de se lancer
  document.addEventListener('DOMContentLoaded', register.init);