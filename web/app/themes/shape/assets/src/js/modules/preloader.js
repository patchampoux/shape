export default class Preloader {
	constructor() {
		this.$body = document.body;
		this.$preloader = document.querySelector('.preloader');

		if (this.$body && this.$preloader) {
			this.$body.classList.remove('is-loading');
			this.$body.classList.add('dom-is-loaded');
			this.addEventListeners();
		}
	}

	addEventListeners() {
		this.$preloader.addEventListener('animationend', this.handleAnimationEnd);
	}

	handleAnimationEnd = () => {
		this.$body.classList.add('is-anim-ready');
		this.$preloader.removeEventListener('animationend', this.handleAnimationEnd);
	}
}