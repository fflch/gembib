material = read.csv("~/Downloads/tombo/TbMaterial.csv")
sugestao = read.csv("~/Downloads/tombo/TbSugestao.csv")
tipo_material = read.csv("~/Downloads/tombo/tbTipodeMaterial.csv")
verba = read.csv("~/Downloads/tombo/tbVerba.csv")
usuarios = read.csv("~/Downloads/tombo/tblUsuários.csv")
subcat = read.csv("~/Downloads/tombo/tbTipodeMaterialSubcategoria.csv")

data = material

# substituir usuários
data = merge(data, usuarios, by.x="IdUsuario", by.y="IdUsuario", all.x=TRUE)

# sugestão
data = merge(data, sugestao, by.x="IdSugestao", by.y="id_sugestao",all.x=TRUE)

# substituir o tipo de material
data = merge(data, tipo_material, by.x="IdTipodeMaterial", by.y="idTipodeMaterial",all.x=TRUE)

# substituir tipo de verba
data = merge(data, verba, by.x="idTipodeVerba", by.y="idTipodeVerba", all.x=TRUE)

# substituir subcategoria
data = merge(data, subcat, by.x="tbTipodeMaterialSubcategoria", by.y="idTipodeMaterialSubcategoria", all.x=TRUE)

final = data.frame(
  "sugerido_por" = data$Usuario, 
  "insercao_por" = data$Usuario,
  "tipo_material" = data$Tipo_de_material)