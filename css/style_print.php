@page {

  size: auto;

  odd-header-name: MyHeader1;

  odd-footer-name: MyFooter1;

}

@page chapter2 {

    odd-header-name: MyHeader2;

    odd-footer-name: MyFooter2;

}

@page noheader {

    odd-header-name: _blank;

    odd-footer-name: _blank;

}

div.chapter2 {

    page-break-before: always;

    page: chapter2;


}


div.noheader {

    page-break-before: always;

    page: noheader;

}



.textoDadosPedido{
  font-size:11px;
  font-family:sans-serif;  
}

.titulos{
  font-size:12px; 
  font-family:sans-serif; 
  text-decoration: underline; 
}

.tabelaTitulos{
  font-size:10px; 
  font-family:sans-serif;  

}

.tabelaItens{
  font-size:10px; 
  font-family:sans-serif;  
}
.obsPedido{
  font-size:10px; 
  font-family:sans-serif;  
}

.dadosEntrega{
  font-size:11px; 
  font-family:sans-serif;  
}

/* dados topo */
.dadosEmpresa{
  font-size:10px; 
  font-family:sans-serif;  
}

.tituloEmpresa{
 font-weight:900;  
 font-family:sans-serif;  
}
