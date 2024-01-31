<template>
    <NavigationTract/>
    <InstallToHomeScreen/>
  <q-page padding>
   <div v-html="tractContent"></div>
  </q-page>
</template>

<script>
import NavigationTract from "components/NavigationTract.vue";
import InstallToHomeScreen from "components/InstallToHomeScreen.vue";
import { setCssVar } from 'quasar'

export default {
  name: 'ViewTract',
  components: {NavigationTract, InstallToHomeScreen },
  data() {
    return {
      tractContent: "",
      rootFontSize: '16px' // example
    }
  },
  mounted() {
    var tractFontSize = localStorage.getItem('tractFontSize' )
    if (tractFontSize == null){
      tractFontSize = '20px'
      localStorage.setItem('tractFontSize',tractFontSize )
    }
    setCssVar('theme-font-size', tractFontSize)
    this.fetchExternalContent();
  },
  methods: {
    async fetchExternalContent() {
      try {
        var page = '/tracts/' + this.$route.params.tract + '.html'
        const response = await fetch(page)
        if (response.ok) {
          this.tractContent = await response.text();
        } else {
          this.tractContent = 'Please access this content while online. The app will then save it for offline use.'
        }
      } catch (error) {
        this.tractContent = 'There was an error fetching this content.  Sorry.'
      }
    },
  },
}
</script>
<style>
:root {
  --primary-color: #009da5;
  --secondary-color: #ffc700;
  --accentd-color: pink;
  --accent-color: #6c5ce7;
  --background-color: #f8f9fa;
}

.tractTitle{
  text-align: right;
}

.section-intro,
.section-law1,
.section-law2,
.section-law3,
.section-law4,
.section-circles,
.div-circles,
.section-prayer,
.section-know,
.section-nowthat,
.section-grow,
.section-feel,
.section-church,
.section-contact
{
	background-color: #fff;
	border:none;
}
.section-title{
	background-color: #fff;
	font-size: 1.2rem;
	line-height: 1.3rem;
	color: var(--accent-color);
	white-space: normal;
	text-align: left;
	position: relative;
	display:table-cell;
}
.section-copyright{
	padding-top: 40px;
	padding-left: 15px;
	padding-right: 15px;
}
table {
  table-layout: fixed;
}
#tract-table{
	border:none;
	background-color: #fff;
}
tbody tr {
  border-top:none;
}
.tract-header{
	background-color: #FFF;
	border:none;
}
tr.tract-row{
	vertical-align: top;
}
td{
	vertical-align:top;
	padding-bottom: 1em;
}
td.side-left,
th.side-left {
  border-bottom: 0;
  padding-left: 5px;
  width: 50%;
  padding-right: 30px;
}
td.side-right,
th.side-right {
  border-bottom: 0;
  width: 50%;
  padding-left: 30px;
  padding-right: 5px;
}
td.side-whole,
th.side-whole {
  border-bottom: 0;
  padding-left: 5px;
  padding-right: 5px;
}
td.tract-image,
td.tract-circle1,
td.tract-circle2{
	text-align: center;
}
td.rtl{
	text-align: right;
}
a{
	color:#aa0040;
}
img.tract-image{
	width: 70%;
	max-width: 300px;
}
.tract-image-image{
	max-width: 90%;
  height: auto;
  width: auto\9; /* ie8 */
}
.tract-image-circle-image{
 max-width: 90%;
  height: auto;
  width: auto\9; /* ie8 */
}



.tract-lawheading{
	font-size: 1.1rem;
	font-weight: bold;
	color:var(--accent-color)

}
.tract-law,
.mylanguage
{
	font-size: 1.1rem;
	line-height:1.3rem;
	font-weight: bold;
  color:var(--accent-color);


}
.tract-law-number{
	font-size: 3rem;
	color: var(--accent-color);
	width:20px;

}

.mylanguage{
	padding-left: 15px;
	padding-right: 15px;
}
.tract-countryname,
.tract-heading{
	font-size: 1.1rem;
	line-height:1.3rem;
	color: var(--primary-color);
	font-weight: bold;
}
a.tract-link{
	color: var(--accent-color);
}
.tract-verse{
	font-size: 1rem;
	line-height:1.3rem;
	font-style: italic;
	color: black

}
.tract-text{
	font-size: 1rem;
	color: #000;

}
.tract-explanation{
	font-size: .8rem;
	color: #000;

}
.tract-circle-image{
		text-align:center;
}
p {
	margin: 10px;

}
p.tract-circle-heading-ltr,
p.tract-circle-heading-rtl,
.tract-circle-heading
{
	font-size: 1.1rem;
  color: var(--primary-color);
	line-height:1.3em;
	text-align:center;
	font-weight: bold;
}
p.tract-circle-subhead,
.tract-circle-image
{
	font-size: 1rem;
	color: #000;
	text-align:center;
	font-weight: bold;
}
p.tract-circle-point-ltr,
.tract-circle-text
{
	font-size: 1rem;
	color: #000;
	text-align:left;
}
p.tract-circle-point-rtl
{
	font-size: 1rem;
	color: #000;
	text-align:right;
	direction: rtl;
}
p.rtl{
	text-align: right;

}
.tract-circle-footer-ltr{
	font-size: 1rem;
	color: #000;
	text-align:center;
	font-weight: normal;
}
.tract-circle-footer-rtl{
	font-size: 1rem;
	color: #000;
	text-align:center;
	font-weight: normal;
	direction: rtl;
}
.tract-circle-explanation,
.tract-circle-explanation-ltr,
.tract-circle-explanation-rtl{
	font-size: .8rem;
	color: #000;
	text-align:center;
}
.tract-heading.translation,
.tract-verse.translation,
.translation{
	color: #aaa;

}
.tract-prayer,
.tract-address,
.bold{
	font-weight: bold;
}



p.tract-circle-point-ltr,
p.tract-circle-point-rtl
 {
  text-indent: -1.3em;
  padding-left: 1.3em;
}
.background{
	margin-left:15px;
	margin-right:15px;
}
li.background{
	margin-left:15px;
}
li.rtl{
		direction:rtl;

	}
h3{
  margin-top: 1em;
}
p.background{
	font-size: 1rem;
}
div.content{
	padding-left:7px;
	padding-right:7px;
}


@media screen and (min-width: 0em) and (max-width: 30.236em) {
	body {
		font-size: .85rem;
		line-height: 1rem;
	}
	link,
	.tract-law{
		font-size: 1rem;
	}
	li,
	.tract-prayer,
	p.tract-circle-point-ltr,
	p.tract-circle-point-rtl,
	.tract-circle-text,
	.tract-circle-footer-ltr,
	.tract-circle-footer-rtl,
	p,
	p.tract-verse,
	.tract-verse,
	.tract-text,
	.tract-countryname,
	.tract-heading {
		font-size: .85rem;
		line-height: 1.1rem;
	}

	.tract-law-number {
		font-size: 2rem;
        width:7px;
		padding-top:5px;
	}
	.title,
	.tract-list-tpl{
		font-size:1.4rem;
		line-height:1.6rem;
	}
	td.side-right, th.side-right {
		border-bottom: 0;
		width: 50%;
		padding-left: 10px;
		padding-right: 3px;
	}
	td.side-left, th.side-left {
		border-bottom: 0;
		padding-left: 3px;
		width: 50%;
		padding-right: 10px;
	}
	img.tract-circle-image{
		width:50%;
		max-width:100px;
	}
	li {
		margin: 3px 3px;
	}
	li.background {
		font-size: 1rem;
		line-height: 1.3rem;
	}
	ul.tract-ul{
		padding-left:10px;
	}

	ul, menu, dir {
		-webkit-padding-start: 10px;
	}
	div.content{
		padding-left:5px;
		padding-right:5px;
	}
}

</style>
