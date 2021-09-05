import 'package:flutter/material.dart';
import 'package:library_app/Screens/Login/constants.dart';

class RoundedButton extends StatelessWidget {
  final String text, fontfamily;
  final VoidCallback press;
  final double fontsize;
  final Color color, textColor;

  const RoundedButton({
    Key? key,
    required this.text,
    required this.press,
    this.color = kSecondaryColor,
    this.textColor = Colors.white,
    this.fontfamily = "SFProDisplay",
    this.fontsize = 16,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Container(
        height: size.height * 0.06,
        width: size.width * 0.8,
        child: ClipRRect(
            borderRadius: BorderRadius.circular(29),
            child: TextButton(
                onPressed: press,
                style: ButtonStyle(
                  padding: MaterialStateProperty.all<EdgeInsets>(
                      EdgeInsets.symmetric(vertical: 10, horizontal: 40)),
                  backgroundColor: MaterialStateProperty.all<Color>(color),
                ),
                child: Text(
                  text,
                  style: TextStyle(
                      color: textColor,
                      fontFamily: fontfamily,
                      fontSize: fontsize,
                      fontWeight: FontWeight.bold),
                ))));
  }
}
