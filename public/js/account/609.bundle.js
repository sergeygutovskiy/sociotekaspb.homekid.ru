(self.webpackChunkhome_cms_fron_webpack=self.webpackChunkhome_cms_fron_webpack||[]).push([[609],{609:(e,n,r)=>{"use strict";r.d(n,{N:()=>N,h:()=>_});var i=r(6730),a=r(5442),o=r(8885),l=r(2646),t=r(6974),s=r(7294),u=r(8238),c=r(3379),d=r.n(c),A=r(9538);d()(A.Z,{insert:"head",singleton:!1});const p=A.Z.locals||{};var x=r(5893),f=function(){var e=(0,o.aC)(),n=e.profile,r=e.handleLogout,i=(0,o.pN)().addError,l=(0,o.yK)(),t=l.apiData,c=l.apiErrors,d=l.isLoading,A=l.isError,f=(0,o._j)(),v=f.apiData,h=f.apiErrors,m=f.isLoading,g=f.isError,C=(0,s.useMemo)((function(){return null!=n?n:{company:null}}),[n]).company,j=(0,s.useMemo)((function(){return A}),[A]),y=(0,s.useMemo)((function(){return g}),[g]);return(0,s.useEffect)((function(){j&&(null==c||c.forEach((function(e){return i(e)}))),y&&(null==h||h.forEach((function(e){return i(e)})))}),[j,y]),(0,x.jsxs)("div",{className:p.styled,children:[(0,x.jsxs)("div",{className:p.half,children:[(0,x.jsx)(a.II,{value:null==C?void 0:C.name,heading:"Краткое наименование организации",readOnly:!0}),(0,x.jsx)(a.Kx,{value:null==C?void 0:C.fullName,heading:"Полное наименование организации",readOnly:!0}),m?(0,x.jsx)(a.Od,{mode:a.rs.INPUT,withLoader:!0,heading:"Тип организации"}):g?(0,x.jsx)(a.II,{value:"",heading:"Тип организации",readOnly:!0}):(0,x.jsx)(a.II,{value:(0,u.s9)(v,null==C?void 0:C.type),heading:"Тип организации",readOnly:!0}),d?(0,x.jsx)(a.Od,{mode:a.rs.INPUT,withLoader:!0,heading:"Район"}):A?(0,x.jsx)(a.II,{value:"",heading:"Район",readOnly:!0}):(0,x.jsx)(a.II,{value:(0,u.s9)(t,null==C?void 0:C.district),heading:"Район",readOnly:!0})]}),(0,x.jsxs)("div",{className:p.half,children:[(0,x.jsx)(a.II,{value:null==C?void 0:C.supervisor,heading:"Руководитель организации",readOnly:!0}),(0,x.jsx)(a.II,{value:null==C?void 0:C.responsible,heading:"Ответственный за предоставление информации",readOnly:!0}),(0,x.jsxs)("div",{className:p.group,children:[(0,x.jsx)(a.H3,{children:"Об организации"}),(0,x.jsx)(a.XZ,{checked:null==C?void 0:C.educationLicense,readOnly:!0,label:(0,x.jsx)(a.xv,{children:"Наличие лицензии на осуществление образовательной деятельности"})}),(0,x.jsx)(a.XZ,{checked:null==C?void 0:C.medicineLicense,readOnly:!0,label:(0,x.jsx)(a.xv,{children:"Наличие лицензии на осуществление медицинской деятельности"})}),(0,x.jsx)(a.XZ,{checked:null==C?void 0:C.innovationGround,readOnly:!0,label:(0,x.jsx)(a.xv,{children:"Наличие инновационной площадки в организации"})})]})]}),(0,x.jsx)("div",{className:p.footer,children:(0,x.jsx)(a.aU,{isDeleteMode:!0,text:"Выйти из аккаунта",onClick:r})})]})},v=r(6156),h=r(2137),m=r(4699),g=r(7757),C=r.n(g),j=r(7668),y=r(2695),b=r(2168);d()(b.Z,{insert:"head",singleton:!1});const w=b.Z.locals||{};function O(e,n){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);n&&(i=i.filter((function(n){return Object.getOwnPropertyDescriptor(e,n).enumerable}))),r.push.apply(r,i)}return r}function E(e){for(var n=1;n<arguments.length;n++){var r=null!=arguments[n]?arguments[n]:{};n%2?O(Object(r),!0).forEach((function(n){(0,v.Z)(e,n,r[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):O(Object(r)).forEach((function(n){Object.defineProperty(e,n,Object.getOwnPropertyDescriptor(r,n))}))}return e}var B=function(){var e,n,r,i,l,c,d,A=(0,o.aC)(),p=A.profile,f=A.updateProfile,g=(0,o.pN)().addError,b=(0,t.s0)(),O=(0,s.useMemo)((function(){return null!=p?p:{company:null}}),[p]).company,B=(0,o.yK)(),N=B.apiData,_=B.apiErrors,I=B.isLoading,k=B.isError,P=(0,o._j)(),L=P.apiData,Z=P.apiErrors,G=P.isLoading,M=P.isError,U=(0,s.useMemo)((function(){return k}),[k]),Q=(0,s.useMemo)((function(){return M}),[M]);(0,s.useEffect)((function(){U&&(null==_||_.forEach((function(e){return g(e)}))),Q&&(null==Z||Z.forEach((function(e){return g(e)})))}),[U,Q]);var D=(0,s.useState)(!1),F=(0,m.Z)(D,2),V=F[0],T=F[1],z=(0,s.useState)(!1),S=(0,m.Z)(z,2),H=S[0],K=S[1],Y=function(){K(!H)},J=(0,s.useState)({name:(0,u.Jh)(null!==(e=null==O?void 0:O.name)&&void 0!==e?e:"",u.vc),fullName:(0,u.Jh)(null!==(n=null==O?void 0:O.fullName)&&void 0!==n?n:"",u.vc),type:null==O?void 0:O.type,district:null==O?void 0:O.district,supervisor:(0,u.Jh)(null!==(r=null==O?void 0:O.supervisor)&&void 0!==r?r:"",u.vc),responsible:(0,u.Jh)(null!==(i=null==O?void 0:O.responsible)&&void 0!==i?i:"",u.vc),educationLicense:null!==(l=null==O?void 0:O.educationLicense)&&void 0!==l&&l,medicineLicense:null!==(c=null==O?void 0:O.medicineLicense)&&void 0!==c&&c,innovationGround:null!==(d=null==O?void 0:O.innovationGround)&&void 0!==d&&d}),R=(0,m.Z)(J,2),X=R[0],q=R[1],W=function(){var e=(0,h.Z)(C().mark((function e(){var n,r,i,a;return C().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(Y(),n={name:X.name,fullName:X.fullName,supervisor:X.supervisor,responsible:X.responsible},(0,u.Kf)(Object.values(n).map((function(e){return{value:e.value,validator:e.validator}})))){e.next=6;break}return g("Проверьте поля на правильность"),e.abrupt("return");case 6:return T(!0),e.prev=7,e.next=10,j.API.profile.update(X);case 10:if(r=e.sent,i=r.errors,a=r.data,!i){e.next=17;break}return i.forEach((function(e){return g(e)})),T(!1),e.abrupt("return");case 17:a?(f({name:X.name.value,fullName:X.fullName.value,type:null==X?void 0:X.type,district:null==X?void 0:X.district,supervisor:X.supervisor.value,responsible:X.responsible.value,educationLicense:null==X?void 0:X.educationLicense,medicineLicense:null==X?void 0:X.medicineLicense,innovationGround:null==X?void 0:X.innovationGround,status:y.R.CONFIRMATION,cause:null}),b("/profile")):(T(!1),g("Не удалось обновить данные профиля!")),e.next=24;break;case 20:e.prev=20,e.t0=e.catch(7),T(!1),g("Произошла критическая ошибка при обновлении данных профиля!");case 24:case"end":return e.stop()}}),e,null,[[7,20]])})));return function(){return e.apply(this,arguments)}}(),$=function(e){var n=[e.target.name,e.target.value],r=n[0],i=n[1],a=X[r].validator(i);q(E(E({},X),{},(0,v.Z)({},r,E(E({},X[r]),{},{value:i,error:{exist:!a.success,text:a.text}}))))},ee=function(e){return function(){q(E(E({},X),{},(0,v.Z)({},e,!X[e])))}},ne=function(e){return function(n){q(E(E({},X),{},(0,v.Z)({},e,n)))}};return(0,x.jsxs)("div",{className:w.styled,children:[(0,x.jsxs)("div",{className:w.half,children:[(0,x.jsx)(a.II,{name:"name",value:X.name.value,onChange:$,error:X.name.error,heading:"Краткое наименование организации"}),(0,x.jsx)(a.Kx,{name:"fullName",value:X.fullName.value,onChange:$,error:X.fullName.error,heading:"Полное наименование организации"}),G?(0,x.jsx)(a.Od,{mode:a.rs.INPUT,withLoader:!0,heading:"Тип организации"}):M?(0,x.jsx)(a.II,{value:"",heading:"Тип организации",readOnly:!0}):(0,x.jsx)(a.Ph,{value:X.type,options:L,heading:"Тип организации",onChangeOption:ne("type")}),I?(0,x.jsx)(a.Od,{mode:a.rs.INPUT,withLoader:!0,heading:"Район"}):k?(0,x.jsx)(a.II,{value:"",heading:"Район",readOnly:!0}):(0,x.jsx)(a.Ph,{value:X.district,options:N,heading:"Район",onChangeOption:ne("district")})]}),(0,x.jsxs)("div",{className:w.half,children:[(0,x.jsx)(a.II,{name:"supervisor",value:X.supervisor.value,onChange:$,error:X.supervisor.error,heading:"Руководитель организации"}),(0,x.jsx)(a.II,{name:"responsible",value:X.responsible.value,onChange:$,error:X.responsible.error,heading:"Ответственный за предоставление информации"}),(0,x.jsxs)("div",{className:w.group,children:[(0,x.jsx)(a.H3,{children:"Об организации"}),(0,x.jsx)(a.XZ,{checked:X.educationLicense,onToggle:ee("educationLicense"),label:(0,x.jsx)(a.xv,{children:"Наличие лицензии на осуществление образовательной деятельности"})}),(0,x.jsx)(a.XZ,{checked:X.medicineLicense,onToggle:ee("medicineLicense"),label:(0,x.jsx)(a.xv,{children:"Наличие лицензии на осуществление медицинской деятельности"})}),(0,x.jsx)(a.XZ,{checked:X.innovationGround,onToggle:ee("innovationGround"),label:(0,x.jsx)(a.xv,{children:"Наличие инновационной площадки в организации"})})]})]}),(0,x.jsxs)("div",{className:w.footer,children:[(0,x.jsx)(a.zx,{onClick:Y,className:w.footer__button,isLoading:I||G||V,disabled:k||M,children:(0,x.jsx)(a.xv,{children:"Отправить на рассмотрение"})}),(0,x.jsx)(a.aU,{text:"Отменить изменения",onClick:function(){return b("/profile")}})]}),(0,x.jsx)(a.u_,{isOpen:H,text:"Вы точно хотите отправить информацию в профиле на рассмотрение? ",submitText:"Отправить",cancelText:"Отменить",onSubmit:W,onCancel:Y})]})},N=function(){var e,n,r=(0,o.aC)().profile,s=(0,t.s0)();return(0,x.jsxs)(a.Ar,{children:[(0,x.jsx)(a.Oo,{paths:[{link:"/profile",alias:"Профиль"}]}),(0,x.jsx)(i.CD,{heading:"Профиль",status:null==r||null===(e=r.company)||void 0===e?void 0:e.status,cause:(0,x.jsxs)(a.xv,{isMedium:!0,children:["Профиль отклонен со следующими ошибками:",(0,x.jsx)("br",{}),null==r||null===(n=r.company)||void 0===n?void 0:n.cause]}),action:(0,x.jsx)(a.aU,{text:"Редактировать",icon:(0,x.jsx)(l.dY,{}),onClick:function(){return s("/profile/edit")}})}),(0,x.jsx)(f,{})]})},_=function(){return(0,o.aC)().profile,(0,t.s0)(),(0,x.jsxs)(a.Ar,{children:[(0,x.jsx)(a.Oo,{paths:[{link:"/profile",alias:"Профиль"},{link:"/profile/edit",alias:"Редактировать профиль"}]}),(0,x.jsx)(i.CD,{heading:"Редактировать профиль"}),(0,x.jsx)(B,{})]})}},2168:(e,n,r)=>{"use strict";r.d(n,{Z:()=>t});var i=r(4015),a=r.n(i),o=r(3645),l=r.n(o)()(a());l.push([e.id,"._2-tiqZM5pLYCOhB0HauzxV{width:100%;display:flex;flex-wrap:wrap;column-gap:100px}._3jfRJghAGDjNgl8Om8AoUb{width:calc(50% - 50px);height:max-content;display:flex;flex-wrap:wrap;gap:30px}._3m0Fy34l7FvSjroeV1rtio{width:100%}._3m0Fy34l7FvSjroeV1rtio>*{margin-bottom:20px}._26r2MzQuEyHU8GoDQ1KQCf{width:100%;margin-top:120px;display:flex;justify-content:left;gap:30px}._1b5CR9bmzXZfmV-2s9P0AQ{width:330px}","",{version:3,sources:["webpack://./src/pagesComponents/ProfileEditorPage/ProfileEditorPage.module.scss"],names:[],mappings:"AAAA,yBACE,UAAA,CACA,YAAA,CACA,cAAA,CACA,gBAAA,CAGF,yBACE,sBAAA,CACA,kBAAA,CACA,YAAA,CACA,cAAA,CACA,QAAA,CAGF,yBACE,UAAA,CAEA,2BACE,kBAAA,CAIJ,yBACE,UAAA,CACA,gBAAA,CACA,YAAA,CACA,oBAAA,CACA,QAAA,CAEA,yBACE,WAAA",sourcesContent:[".styled {\n  width: 100%;\n  display: flex;\n  flex-wrap: wrap;\n  column-gap: 100px;\n}\n\n.half {\n  width: calc(50% - 50px);\n  height: max-content;\n  display: flex;\n  flex-wrap: wrap;\n  gap: 30px;\n}\n\n.group {\n  width: 100%;\n\n  & > * {\n    margin-bottom: 20px;\n  }\n}\n\n.footer {\n  width: 100%;\n  margin-top: 120px;\n  display: flex;\n  justify-content: left;\n  gap: 30px;\n\n  &__button {\n    width: 330px;\n  }\n}\n"],sourceRoot:""}]),l.locals={styled:"_2-tiqZM5pLYCOhB0HauzxV",half:"_3jfRJghAGDjNgl8Om8AoUb",group:"_3m0Fy34l7FvSjroeV1rtio",footer:"_26r2MzQuEyHU8GoDQ1KQCf",footer__button:"_1b5CR9bmzXZfmV-2s9P0AQ"};const t=l},9538:(e,n,r)=>{"use strict";r.d(n,{Z:()=>t});var i=r(4015),a=r.n(i),o=r(3645),l=r.n(o)()(a());l.push([e.id,"._1zjHf9LvT64mlsr73zZHgy{width:100%;display:flex;flex-wrap:wrap;column-gap:100px}._15B1BlqM8PMytgttExpA7e{width:calc(50% - 50px);height:max-content;display:flex;flex-wrap:wrap;gap:30px}.tbeCGbcKx8Gn5vVFW2QBB{width:100%}.tbeCGbcKx8Gn5vVFW2QBB>*{margin-bottom:20px}._2O9_QPAMqhee7sSVwsVtNn{width:100%;margin-top:120px;display:flex;justify-content:center}","",{version:3,sources:["webpack://./src/pagesComponents/ProfilePage/ProfilePage.module.scss"],names:[],mappings:"AAAA,yBACE,UAAA,CACA,YAAA,CACA,cAAA,CACA,gBAAA,CAGF,yBACE,sBAAA,CACA,kBAAA,CACA,YAAA,CACA,cAAA,CACA,QAAA,CAGF,uBACE,UAAA,CAEA,yBACE,kBAAA,CAIJ,yBACE,UAAA,CACA,gBAAA,CACA,YAAA,CACA,sBAAA",sourcesContent:[".styled {\n  width: 100%;\n  display: flex;\n  flex-wrap: wrap;\n  column-gap: 100px;\n}\n\n.half {\n  width: calc(50% - 50px);\n  height: max-content;\n  display: flex;\n  flex-wrap: wrap;\n  gap: 30px;\n}\n\n.group {\n  width: 100%;\n\n  & > * {\n    margin-bottom: 20px;\n  }\n}\n\n.footer {\n  width: 100%;\n  margin-top: 120px;\n  display: flex;\n  justify-content: center;\n}\n"],sourceRoot:""}]),l.locals={styled:"_1zjHf9LvT64mlsr73zZHgy",half:"_15B1BlqM8PMytgttExpA7e",group:"tbeCGbcKx8Gn5vVFW2QBB",footer:"_2O9_QPAMqhee7sSVwsVtNn"};const t=l}}]);
//# sourceMappingURL=609.bundle.js.map