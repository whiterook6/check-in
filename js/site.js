(function(){
	angular
		.module('Check-in', ['ngResource'])
		.controller('CheckinController', [function(){
			var ctrl = this;
			
			ctrl.projects = {
				list: [{
					id: 1,
					title: 'Pillar',
					description: 'Cow laborum est cillum pariatur. Tongue adipisicing dolor bresaola excepteur commodo, incididunt cupim nulla. Ipsum dolore incididunt ham, alcatra corned beef shank ground round cupidatat laboris mollit anim. Short ribs beef non, ground round pastrami in salami turkey adipisicing ribeye',
					url: 'http://dev.campaignpillar.com'
				}],

				forms: {
					add: {
						visible: false,
						active: false,
						promise: null
					}
				}
			};
		}]);
})();
